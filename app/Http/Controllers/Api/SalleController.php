<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalleRequest;
use App\Http\Resources\SalleResource;
use App\Models\Salle;
use Illuminate\Http\Request;
use OpenApi\Attributes\OpenApi as OA;

class SalleController extends Controller
{
    /**
     * Affiche la liste des ressources Salles
     */
    #[OA\Get(
        path: "/salles",
        operationId: "index",
        description: "La liste des salles",
        security: [["bearerAuth" =>  ['role'=>'visiteur']],],
        tags: ["Salles"],
        responses: [
            new OA\Response(
                response: 200,
                description: "La liste des salles",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "data",
                            type: "array",
                            items: new OA\Items(ref: "#/components/schemas/Salle", type: "object")
                        )
                    ]
                )
            )
        ]
    )]

    public function index()
    {
        $salles = Salle::all();
        return SalleResource::collection($salles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalleRequest $request)
    {
        // si içi la requête est valide
        $salle = Salle::create($request->input());
        return response()->json([
            'message'=>"Salle créer avec succès",
            'data'=> new SalleResource($salle),
            ],status:200);


    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $salle = Salle::findOrFail($id);
        return new SalleResource($salle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalleRequest $request, int $id) {
         $salle = Salle::findOrFail($id);
 $salle->update($request->all());
 return response()->json([
             'status' => true,
             'message' => "salle updated successfully!",
             'salle' => new SalleResource($salle)
             ], 200);}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return response()->json([
            'status' => true,
            'message' => "salle delete successfully!"
        ], 200);
    }

}
