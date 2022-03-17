<?php 

namespace App\Models\TransfertManager;

use App\Models\Account;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class creatAccount extends Account 
{


	public function Action(Request $request, Response $response, array $args) 
    { 
        $data = $request->getParsedBody();
        $this->numAccount = random_int(3000000000, 3999999999);
    	$this->ownerId=htmlspecialchars(strip_tags($data["ownerId"])); 
        $this->balance = 0;
	    $this->currency=htmlspecialchars(strip_tags($data["currency"]));

        $db = new Database();
        $sql = "INSERT INTO  $this->table SET numAccount=:numAccount, 
        ownerId=:ownerId, balance=:balance, currency=:currency"; 
 		$query = $db->getConnection()->prepare($sql);


 		$query->bindParam(":numAccount", $this->numAccount);
        $query->bindParam(":ownerId", $this->ownerId);
	    $query->bindParam(":balance", $this->balance);
        $query->bindParam(":currency", $this->currency);
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
