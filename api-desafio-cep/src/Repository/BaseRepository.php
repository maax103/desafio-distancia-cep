<?php

namespace App\Repository;

use PDO;

class BaseRepository
{
    protected PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
}
