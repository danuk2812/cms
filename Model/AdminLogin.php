<?php

namespace Shop\Model;

use Shop\Service\DataBase;

class AdminLogin
{
    private \Medoo\Medoo $dbConnect;

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->dbConnect = DataBase::getInstance();
    }

    public function login($login, $password): bool
    {
        $result = $this->dbConnect->select(
            'user', ['login', 'password', 'is_approved'],
            [
                "AND" => [
                    'login' => $login,
                    'password' => $password
                ]
            ]
        );
        if (!empty($result)) {

            $_SESSION['user'] = $result[0]['login'];
            $_SESSION['is_approved'] = $result[0]['is_approved'];

            return true;
        } else {
            return false;
        }
    }

    public function validateAdmin(): bool
    {
        return !empty($_SESSION['user']);
    }

    public function logout()
    {
        session_destroy();
    }
}