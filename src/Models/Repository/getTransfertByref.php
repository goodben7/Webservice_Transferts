<?php

namespace App\Models\Repository;

use App\Models\Transfert;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class getTransfertByref extends Transfert 
{
    
	public function Action(Request $request, Response $response, array $args) 
    {
        $db = new Database();
        $this->reference = $args['reference'];
        $sql = "SELECT * FROM $this->table WHERE reference =  '$this->reference'";
        $query = $db->getConnection()->prepare($sql);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row == true) 
        {
            $response->getBody()->write(json_encode($row));
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
