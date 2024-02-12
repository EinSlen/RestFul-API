<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: "Salle", properties: [
    new OA\Property(property: "id", type: "integer", format: "int64"),
    new OA\Property(property: "nom", type: "string"),
    new OA\Property(property: "adresse", type: "string"),
    new OA\Property(property: "codePostal", type: "string"),
    new OA\Property(property: "ville", type: "string")
])]

use OpenApi\Attributes as OA;

#[OA\Schema(schema:"Salle", properties: [
    new OA\Property(property: "id", type: "integer", format: "int64"),
    new OA\Property(property: "nom", type: "string"),
    new OA\Property(property: "adresse", type: "string"),
    new OA\Property(property: "codePostal", type: "string"),
    new OA\Property(property: "ville", type: "string"),
])]
class Salle extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nom', 'adresse', 'code_postal', 'ville'];
}
