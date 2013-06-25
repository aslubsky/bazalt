<?php

namespace Components\Errors\Controller;

use Framework\CMS as CMS;
use Components\Errors\Model;

class Index extends CMS\AbstractController
{
    public function defaultAction($id = null)
    {
        $user = CMS\User::get();
        if ($user->isGuest()) {
            $this->view->display('login');
            exit;
        }
        $this->view->display('index');
    }
}