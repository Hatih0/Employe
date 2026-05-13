<?php 

namespace App\Models;
use CodeIgniter\Model;

class EmployeModel extends Model
{
    protected $table = 'employes';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'departement_id',
        'date_embauche',
        'actif',
    ];

    protected $validationRules = [
        'password' => 'required|min_length[6]',
        'email'      => 'required|valid_email|is_unique[employes.email]',
    ];

    public function checkEmploye(string $email, string $password): ?array
    {
        $user = $this->where('email', $email)->first();
        if ($user && $user['password'] === $password) {
            return $user;
        }
        return null; 
    }

    public function getAllEmployes()
    {
        return $this->findAll();
    }

    public function getEmployeById($id)
    {
        return $this->find($id);
    }

    public function createEmploye($data)
    {
        // Hash the password if provided
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->insert($data);
    }

    public function updateEmploye($id, $data)
    {
        // Hash the password if provided
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->update($id, $data);
    }

    public function deleteEmploye($id)
    {
        return $this->delete($id);
    }
}
