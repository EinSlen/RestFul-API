<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OA;


#[OA\Schema(schema:"Client", properties: [
    new OA\Property(property: "id",type: "integer"),


])]
class Client extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $guarded = ['id'];

    public function avis() {

    }
}
