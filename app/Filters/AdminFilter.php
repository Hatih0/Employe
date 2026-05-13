<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->get('is_logged_in')) {
            return redirect()->to('/')->with('error', 'Vous devez être connecté.');
        }

        $role = $session->get('role');
        if ($role !== 'admin' && $role !== 'Admin' && $role !== 'administrateur') {
            return redirect()->to('/dashboard')->with('error', 'Accès refusé. Vous devez être administrateur.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
