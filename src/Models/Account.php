<?php

namespace App\Models;

use \PDO;

class Account
{
    private $connexion;
    
    // Table dans la base des données
    public $table = "Account"; 


    // Propriétés
    public int $id;
    public string $numAccount;
    public string $ownerId;
    public float $balance;
    public string $currency;
}


