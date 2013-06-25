<?php

namespace Components\Errors;

use \Framework\CMS as CMS;
use \Framework\CMS\Route;

class Component extends CMS\Component
{
    public static function getName()
    {
        return 'Errors';
    }

    public function getRoles()
    {
        return array();
    }

    public function initComponent(CMS\Application $application)
    {
        if ($application instanceof \Components\Errors\Application) {
            // $application->registerJsComponent('Component.Pages', relativePath(__DIR__ . '/component.js'));
        } else {
            // $application->registerJsComponent('Component.Pages.Admin', relativePath(__DIR__ . '/admin.js'));
        }
        
        CMS\Route::root()->connect('Hosts.List', '/hosts/', ['controller' => 'Components\Errors\Controller\Index', 'action' => 'default']);
        CMS\Route::root()->connect('Errors.View', '/error/view/{id}/', ['controller' => 'Components\Errors\Controller\Index', 'action' => 'default']);
        CMS\Route::root()->connect('Errors.ByHost', '/errors/host/{id}/', ['controller' => 'Components\Errors\Controller\Index', 'action' => 'default']);
        CMS\Route::root()->connect('Errors.Archive', '/errors/archive/', ['controller' => 'Components\Errors\Controller\Index', 'action' => 'default']);
        CMS\Route::root()->connect('Errors.Archive.ByHost', '/errors/archive/host/{id}/', ['controller' => 'Components\Errors\Controller\Index', 'action' => 'default']);
        
        if(CMS\User::isLogined()) {
            $application->view->assignGlobal('hosts', Model\Host::getList());

            $application->view()->assignGlobal('hostsCount', Model\Host::getTotalCount());
            $application->view()->assignGlobal('errorsCount', Model\Error::getTotalCount());
            $application->view()->assignGlobal('todayErrorsCount', Model\Error::getTodayCount());
        }
        $application->view()->assignGlobal('curUser', CMS\User::get());
    }
}
