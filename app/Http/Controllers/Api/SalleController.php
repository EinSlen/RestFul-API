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
            'data'=> $salle,
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
