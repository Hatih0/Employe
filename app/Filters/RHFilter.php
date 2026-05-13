<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RHFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $role = $session->get('role');
        if ($role !== 'rh' && $role !== 'RH' && $role !== 'Responsable RH') {
            return redirect()->to('/dashboard')->with('error', 'Accès refusé. Vous devez être RH.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
