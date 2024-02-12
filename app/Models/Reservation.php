<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;use OpenApi\Attributes as OA;

#[OA\Schema(schema:"Reservation", properties: [
    new OA\Property(property: "id",type: "integer"),


])]
class Reservation extends Model {
    use HasFactory;

    protected $guarded = ['id'];
}
