<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    /*
    public function toArray($request) {
        return [
            'id' => $this->id,
            'nom_complet' => sprintf("%s %s",$this->prenom, $this->nom),
            'age' => $this-> age
        ];
    }*/
}
