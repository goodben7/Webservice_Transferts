<?php

namespace App\Models;

use \PDO;

class Beneficiary
{
    private $connexion;

    // Table dans la base des données
    public $table = "Beneficiary"; 

    // Propriétés
    public $id;
    public $ownerId;
    public $userIdBeneficiary;
    public $label;
}