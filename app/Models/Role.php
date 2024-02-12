<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
