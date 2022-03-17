<?php

namespace App\Models\Repository;

use App\Models\Country;
use App\Models\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \PDO;

class getCountrycode extends Country 
{
    
	public function Action(Request $request, Response $response, array $args) 
    {
        $db = new Database();
        $this->countryName = $args['countryName'];
        $sql = "SELECT countryCode FROM $this->table WHERE 
        countryName = '$this->countryName' ";
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
