<?php

namespace App\Controller\Dashboard;


use App\App\Session;
use App\App\ViewHTML;

class DashboardController
{

    public function index()
    {
        $user = Session::get('user');
        return ViewHTML::view('dashboard/index', $user);
    }

}