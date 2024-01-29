<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalleRequest;
use App\Http\Resources\SalleResource;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller {
    /**
     * Display a listing of the resource.
     */
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
     * Display the specified resource.
     */
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
