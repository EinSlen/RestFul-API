<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalleRequest;
use App\Http\Resources\SalleResource;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
