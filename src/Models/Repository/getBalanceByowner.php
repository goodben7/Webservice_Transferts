<?php

namespace App\Models\Repository;

use App\Models\Account;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class getBalanceByowner extends Account 
{
    
	public function Action(Request $request, Response $response, array $args) 
    {
        $db = new Database();
        $this->ownerId = $args['ownerId'];
        $sql = "SELECT balance FROM $this->table WHERE ownerId = '$this->ownerId' ";
        $query = $db->getConnection()->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        if ($data == true) 
        {
            $response->getBody()->write(json_encode($data));
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
