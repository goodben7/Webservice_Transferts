<?php 

namespace App\Models\TransfertManager;

use App\Models\Transfert;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request; 
use \PDO;

class creatTransfert extends Transfert 
{
	public function Action(Request $request, Response $response, array $args) 
    { 
        $data = $request->getParsedBody();
    	$this->ownerId=htmlspecialchars(strip_tags($data["ownerId"]));
        $this->userIdBeneficiary=htmlspecialchars(strip_tags($data["userIdBeneficiary"]));
        $this->amountSent=htmlspecialchars(strip_tags($data["amountSent"]));
        $this->amountReceived=htmlspecialchars(strip_tags($data["amountReceived"]));
        $this->currency=htmlspecialchars(strip_tags($data["currency"]));
        $bytes = random_bytes(7);
        $this->numAccount = htmlspecialchars(strip_tags($data["numAccount"]));
        $this->reference = bin2hex($bytes);
        $this->taux = htmlspecialchars(strip_tags($data["taux"]));
        $this->label = htmlspecialchars(strip_tags($data["label"]));
	   

        $db = new Database();
        $sql = "INSERT INTO  $this->table SET ownerId=:ownerId, 
        userIdBeneficiary=:userIdBeneficiary, amountSent=:amountSent, 
        amountReceived=:amountReceived, currency=:currency, numAccount=:numAccount, 
        reference=:reference, taux=:taux, label=:label"; 
 
 		$query = $db->getConnection()->prepare($sql);


 		$query->bindParam(":ownerId", $this->ownerId);
        $query->bindParam(":userIdBeneficiary", $this->userIdBeneficiary);
	    $query->bindParam(":amountSent", $this->amountSent);
        $query->bindParam(":amountReceived", $this->amountReceived);
        $query->bindParam(":currency", $this->currency);
        $query->bindParam(":numAccount", $this->numAccount);
        $query->bindParam(":reference", $this->reference);
        $query->bindParam(":taux", $this->taux);
        $query->bindParam(":label", $this->label);
	    $query = $query->execute();
     
        if ($query == true) 
        {
            $sql = "UPDATE account SET balance = balance - $this->amountSent WHERE 
            ownerId = $this->ownerId ";
            $query = $db->getConnection()->prepare($sql);
            $query->execute();

            $sql = "UPDATE account SET balance = balance + $this->amountReceived WHERE 
            ownerId = $this->userIdBeneficiary ";
            $query = $db->getConnection()->prepare($sql);
            $query->execute();


        	$sql = "SELECT * FROM $this->table ORDER BY ID DESC LIMIT 1";
        	$query = $db->getConnection()->prepare($sql);
        	$query->execute();
        	$row = $query->fetch(PDO::FETCH_ASSOC);
            $response->getBody()->write(json_encode($row));
            return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
        }
        else
        {
            $error = array("message" => "Application Error");
            $response->getBody()->write(json_encode($error));
            return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(500);
        }
    }	
}
