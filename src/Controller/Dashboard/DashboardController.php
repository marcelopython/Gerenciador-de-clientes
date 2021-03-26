<?php

namespace Kabum\App\Controller\Dashboard;


use Kabum\App\Session;
use Kabum\App\ViewHTML;

class DashboardController
{

    public function index()
    {
        $user = Session::get('user');
        return ViewHTML::view('dashboard/index', $user);
    }

}