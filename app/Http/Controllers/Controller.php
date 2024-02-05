<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0",
    description: "Serveur Api Documentation pour l'application activité-sport",
    title: "Serveur Api Activité Sport",
)]
#[OA\Server(description:"Docs serveur", url: "http://localhost:8000/api")]
#[OA\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', bearerFormat: 'JWT', scheme: 'bearer')]
class OpenApi {}

class Controller extends BaseController {
    use AuthorizesRequests, ValidatesRequests;
}
