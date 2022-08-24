<?php

namespace Shop\Service;

use Medoo\Medoo;

class DataBase
{
    static function getInstance(): Medoo
    {
        include 'app/config/db.php';
        return new Medoo($dbConfig);
    }
}