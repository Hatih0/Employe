<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class DashboardEmployeController extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/')
                ->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        return view('employe/dashboard/dashboard');
    }
}