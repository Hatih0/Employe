<?php
namespace App\Models;

use CodeIgniter\Model;

class CongeModel extends Model
{
    protected $table = 'conges';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $skipValidation = true;
    protected $allowedFields = ['employe_id', 'type_conge_id', 'date_debut',
                                'date_fin', 'nb_jours', 'motif',
                                'statut', 'commentaire_rh', 'traite_par', 'created_at'];

    private $soldeModel;
    private $employeModel;

    public function __construct()
    {
        parent::__construct();
        $this->soldeModel = new SoldeModel();
        $this->employeModel = new EmployeModel();
    }

    // ========== RECUPERER LES CONGES ==========
    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getById(int $id): ?array
    {
        return $this->find($id);
    }

    // ========== VER LES DEMANDES EN ATTENTE ==========
    public function getDemandeCongesEnAttente(): array
    {
        return $this->where('statut', 'en_attente')->findAll();
    }

    // ========== APPROUVER OU REFUSER UNE DEMANDE ==========
    public function reponseConge(int $id, string $statut, ?string $commentaire = null, ?string $traite_par = null): bool
    {
        $conge = $this->getById($id);
        
        if (!$conge) {
            return false;
        }

        // Validation du statut
        if (!in_array($statut, ['approuve', 'refuse'])) {
            return false;
        }

        $data = ['statut' => $statut];
        if ($commentaire !== null) {
            $data['commentaire_rh'] = $commentaire;
        }
        if ($traite_par !== null) {
            $data['traite_par'] = $traite_par;
        }

        $result = $this->update($id, $data);

        // Si approbation, mettre à jour le solde en incrémentant jours_pris
        if ($result && $statut === 'approuve') {
            // Extraire l'année de la date_debut du congé
            $annee = (int)date('Y', strtotime($conge['date_debut']));
            
            // Incrémenter jours_pris avec nb_jours
            $this->soldeModel->updateSolde(
                $conge['employe_id'],
                $conge['type_conge_id'],
                $annee,
                $conge['nb_jours']
            );
        }

        return $result;
    }

    // ========== TRAITER UN CONGE (FONCTION MODERNISEE) ==========
    public function traiterConge(int $id, string $statut, ?string $commentaire = null, ?string $traite_par = null): bool
    {
        return $this->reponseConge($id, $statut, $commentaire, $traite_par);
    }

    // ========== CREER UNE DEMANDE DE CONGE ==========
    public function demanderConge(array $data): int|false
    {
        // Insérer la demande de congé
        $result = $this->insert($data);
        
        if ($result) {
            // Récupérer l'année de la date_debut
            $annee = (int)date('Y', strtotime($data['date_debut']));
            
            // Vérifier si un solde existe pour cet employé/type_conge/année
            $soldeExistant = $this->soldeModel->getSoldeEmploye(
                $data['employe_id'],
                $data['type_conge_id'],
                $annee
            );
            
            // Si le solde n'existe pas, le créer avec jours_attribues = jours_annuels du type
            if (!$soldeExistant) {
                $typeCongeModel = new TypeCongeModel();
                $typeCong = $typeCongeModel->find($data['type_conge_id']);
                
                if ($typeCong) {
                    $this->soldeModel->creerSolde(
                        $data['employe_id'],
                        $data['type_conge_id'],
                        $annee,
                        $typeCong['jours_annuels']
                    );
                }
            }
        }
        
        return $result;
    }

    // ========== METTRE A JOUR UN CONGE ==========
    public function updateConge(int $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    // ========== FILTRER PAR DEPARTEMENT ==========
    public function filtrerCongesParDepartement(int $departement_id): array
    {
        $employes = $this->employeModel->where('departement_id', $departement_id)->findAll();
        
        $conges = [];
        foreach ($employes as $employe) {
            $congesEmploye = $this->where('employe_id', $employe['id'])->findAll();
            $conges = array_merge($conges, $congesEmploye);
        }
        
        return $conges;
    }

    // ========== FILTRER PAR STATUT ==========
    public function filtrerCongesParStatut(string $statut): array
    {
        if (!in_array($statut, ['en_attente', 'approuve', 'refuse'])) {
            return [];
        }
        return $this->where('statut', $statut)->findAll();
    }

    // ========== FILTRER PAR DEPARTEMENT ET STATUT ==========
    public function filtrerCongesParDepartementEtStatut(int $departement_id, string $statut): array
    {
        $employes = $this->employeModel->where('departement_id', $departement_id)->findAll();
        
        $conges = [];
        foreach ($employes as $employe) {
            $congesEmploye = $this->where('employe_id', $employe['id'])
                                   ->where('statut', $statut)
                                   ->findAll();
            $conges = array_merge($conges, $congesEmploye);
        }
        
        return $conges;
    }

    // ========== VER LE SOLDE D'UN EMPLOYE ==========
    public function getSoldeEmploye(int $employe_id, int $annee = null): array
    {
        if ($annee === null) {
            $annee = (int)date('Y');
        }
        
        return $this->soldeModel->where('employe_id', $employe_id)
                                ->where('annee', $annee)
                                ->findAll();
    }

    // ========== VER LES JOURS RESTANTS POUR UN TYPE DE CONGE ==========
    public function joursRestants(int $employe_id, int $type_conge_id, int $annee = null): int
    {
        if ($annee === null) {
            $annee = (int)date('Y');
        }
        
        return $this->soldeModel->jours_restants($employe_id, $type_conge_id, $annee);
    }

    // ========== CREER LE SOLDE INITIAL POUR UN EMPLOYE ==========
    public function initierSoldeEmploye(int $employe_id, int $annee = null): bool
    {
        if ($annee === null) {
            $annee = (int)date('Y');
        }

        $typeCongeModel = new TypeCongeModel();
        $typesConges = $typeCongeModel->findAll();

        foreach ($typesConges as $type) {
            // Vérifier si le solde existe déjà
            $soldeExistant = $this->soldeModel->getSoldeEmploye($employe_id, $type['id'], $annee);
            if (!$soldeExistant) {
                $this->soldeModel->creerSolde($employe_id, $type['id'], $annee, $type['jours_annuels']);
            }
        }

        return true;
    }

    // ========== OBTENIR LES CONGES AVEC LES DETAILS DE L'EMPLOYE ET DU DEPARTEMENT ==========
    public function getCongesAvecDetails(int $conge_id = null): array
    {
        $query = $this->db->table($this->table)
                          ->select('conges.*, employes.nom, employes.prenom, employes.email, departements.nom as departement_nom')
                          ->join('employes', 'employes.id = conges.employe_id', 'left')
                          ->join('departements', 'departements.id = employes.departement_id', 'left');
        
        if ($conge_id !== null) {
            $query->where('conges.id', $conge_id);
            return $query->get()->getResultArray();
        }
        
        return $query->get()->getResultArray();
    }
}

