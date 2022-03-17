<?php

namespace App\Models;

use \PDO;

class Transfert
{
    private $connexion;

    // Table dans la base des données
    public $table = "Transfert"; 

    // Propriétés
    public $id;
    public $ownerId;
    public $userIdBeneficiary;
    public $amountSent;
    public $amountReceived;
    public $currency;
    public $dateTransfert;
    public $numAccount;
    public $reference;
    public $taux;
    public $label; 
}