<?php 

namespace App\Models\TransfertManager;

use App\Models\Beneficiary;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class removeBeneficiary extends Beneficiary 
{
    
	public function Action(Request $request, Response $response, array $args) 
    {

        $db = new Database();
        $this->id = $args['id'];
        $sql = "DELETE FROM $this->table WHERE id = $this->id";
        $query = $db->getConnection()->prepare($sql);
        $return = $query->execute();
        if ($return == true) 
        {
            $message = array("message" => "item deleted successfully");
            $response->getBody()->write(json_encode($message));
            return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(200);
        }
        else
        {
            $error = array("message" => "NOT FOUND");
            $response->getBody()->write(json_encode($error));
            return $response
            ->withHeader('content-type', 'application/json')
            ->withStatus(404);
        }
    }	
}
