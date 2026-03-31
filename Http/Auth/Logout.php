<?php

namespace Auth;

use Auth\Auth;
use database\Database;

class Logout extends Auth
{
    // logout 
    public function logout()
    {
        $db = DataBase::getInstance();

        if (isset($_SESSION['tar_employee']['id'])) {
            $db->update('employees', $_SESSION['tar_employee']['id'], [
                'expire_remember_token',
                'remember_token'
            ], [0, null]);
        }

        if (isset($_SESSION['tar_admin']['id'])) {
            $db->update('employees', $_SESSION['tar_admin']['id'], [
                'expire_remember_token',
                'remember_token'
            ], [0, null]);
        }

        $sessionsToUnset = [
            'tar_employee',
            'tar_admin',
            'sk_em_name',
            'user_permissions',
            'csrf_token',
            'temporary_old',
            'old'
        ];

        foreach ($sessionsToUnset as $sessionKey) {
            unset($_SESSION[$sessionKey]);
        }

        session_destroy();

        if (isset($_COOKIE['tar_user'])) {
            setcookie("tar_user", '', time() - 3600, '/', '', true, true);
        }

        $this->redirect('login');
        exit();
    }
}
