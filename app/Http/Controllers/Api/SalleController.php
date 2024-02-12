<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalleRequest;
use App\Http\Resources\SalleResource;
use App\Models\Salle;
use Illuminate\Http\Request;

use OpenApi\Attributes as OA;

class SalleController extends Controller {
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

    public function index() {
        $salles = Salle::all();
        return SalleResource::collection($salles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalleRequest $request) {
        // Si j'arrive ici, la requête est correcte (les données sont valides)
        $salle = Salle::create($request->input());
        return response()->json([
            'message' => "Salle créée avec succès",
            'data' => new SalleResource($salle),
        ], 200);
    }

    /**
     * Affiche le détail d'une salle
     */
    #[OA\Get(
        path: "/salles/{id}",
        operationId: "show",
        description: "Détails d'une salle",
        security: [["bearerAuth" => ["role" => "view-salle"]],],
        tags: ["Salles"],
        parameters: [
            new OA\Parameter(
                name: "id",
                description: "Identifiant de la salle",
                in: "path",
                required: "true",
                schema: new OA\Schema(type: "integer", format: 'int64'))
        ],
        responses: [
            new OA\Response(response: 200,
                description: "Détails d'une salle",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "data", ref: "#/components/schemas/Salle", type: "object"),
                ], type: "object")
            ),
            new OA\Response(response: 404, description: "Salle non trouvée",
                content: new OA\JsonContent(properties: [
                    new OA\Property(property: "message", type: "string"),
                    new OA\Property(property: "errors", properties: [
                        new OA\Property(property: "id", type: "array", items: new OA\Items(type: "string"))
                    ], type: "object"
                    ),
                ], type: "object"))
        ]
    )]

    public function show(string $id) {
        $salle = Salle::findOrFail($id);

        return response()->json([
            'message' => "Détails d'une salle",
            'data' => new SalleResource($salle),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalleRequest $request, string $id) {
        // Si j'arrive ici, la requête est correcte (les données sont valides)
        $salle = Salle::findOrFail($id);
        $salle->update($request->input());

        return response()->json([
            'message' => "Salle modifiée avec succès",
            'data' => new SalleResource($salle),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $salle = Salle::findOrFail($id);
        $salle->delete();
        return response()->json([
            'message' => "suppression salle",
        ], 200);
    }
}
