<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;


#[OA\Schema(schema:"Role", properties: [
    new OA\Property(property: "ADMIN",type: "Const"),
    new OA\Property(property: "CREATE_SALLE",type: "Const"),
    new OA\Property(property: "EDIT_SALLE",type: "Const"),
    new OA\Property(property: "VIEW_SALLE",type: "Const"),
    new OA\Property(property: "VISITEUR",type: "Const"),

])]
class Role extends Model {
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['nom'];

    const ADMIN = "admin";
    const CREATE_SALLE = "create-salle";
    const EDIT_SALLE = "edit-salle";
    const VIEW_SALLE = "view-salle";
    const VISITEUR = "visiteur";

    const ROLES = [self::ADMIN, self::CREATE_SALLE, self::EDIT_SALLE, self::VIEW_SALLE, self::VISITEUR,];
}
