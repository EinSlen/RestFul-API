<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", description: "sERVEUR api documentation application activité sport",
    title: "API activité sport")]
#[OA\Server(description:"serveur api", url: "http://localhost:8000/api/salles")]
#[OA\SecurityScheme()]
class OpenApi {}

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
