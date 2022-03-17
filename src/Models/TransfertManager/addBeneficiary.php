<?php 

namespace App\Models\TransfertManager;

use App\Models\Beneficiary;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class addBeneficiary extends Beneficiary 
{
	public function Action(Request $request, Response $response, array $args) 
    {
        $db = new Database();
    	$data = $request->getParsedBody();
    	$this->ownerId=htmlspecialchars(strip_tags($data["ownerId"]));
        $this->numAccount=htmlspecialchars(strip_tags($data["numAccount"]));
        $this->label=htmlspecialchars(strip_tags($data["label"]));

        $sql = "SELECT ownerId FROM Account WHERE numAccount = '$this->numAccount'";
        $query = $db->getConnection()->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($data == true) 
        {
            $this->userIdBeneficiary=htmlspecialchars(strip_tags($data['ownerId']));
        }
        else 
        {
            $error = array("message" => "Application Error Account Number Not Found");
            $response->getBody()->write(json_encode($error));
            return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(400);
        }

        $sql = "INSERT INTO  $this->table SET ownerId=:ownerId, 
 		userIdBeneficiary=:userIdBeneficiary, label=:label";
 		$query = $db->getConnection()->prepare($sql);


 		$query->bindParam(":ownerId", $this->ownerId);
	    $query->bindParam(":userIdBeneficiary", $this->userIdBeneficiary);
	    $query->bindParam(":label", $this->label);
	    $query = $query->execute();
     
        if ($query == true) 
        {
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
