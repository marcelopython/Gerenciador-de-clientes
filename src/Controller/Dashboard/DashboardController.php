<?php

namespace Kabum\App\Controller\Dashboard;


use Kabum\App\ViewHTML;

class DashboardController
{

    public function index()
    {
        return ViewHTML::view('dashboard/index');
    }

}