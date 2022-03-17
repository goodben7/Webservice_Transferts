<?php

namespace App\Models\Repository;

use App\Models\Country;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class getCountries extends Country 
{
    
	public function Action(Request $request, Response $response, array $args) 
    {
        $db = new Database();
        $sql = "SELECT * FROM $this->table";
        $query = $db->getConnection()->prepare($sql);
        $query->execute();
        $array = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($array == true) 
        {
            $response->getBody()->write(json_encode($array));
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
