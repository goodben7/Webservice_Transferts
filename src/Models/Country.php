<?php

namespace App\Models;

use \PDO;

class Country
{ 
    private $connexion;

    // Table dans la base des données
    public $table = "Country"; 

    // Propriétés
    public $id;
    public $countryCode;
    public $countryName;
    public $currency;   
}