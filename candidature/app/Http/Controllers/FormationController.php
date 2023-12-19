<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use App\Http\Requests\StoreFormationRequest;
use App\Http\Requests\UpdateFormationRequest;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormationRequest $request)
    {
        try {
            $role=User::where('role','admin');
            
             $donneeFormationValide = $request->validated();
             
             $formation = new Formation($donneeFormationValide);
     
             if ($formation->save()) {
                 return response()->json([
                     
                     "message" => "Formation ajoutée avec succès"
                 ], 201);
             } else {
                 return response()->json([
                   
                     "message" => "Echec ajout Formation"
                 ], 500);
             }
            } catch (\Throwable $th) {
             return response()->json([
                 "status" => 0,
                 "messageErreur" => $th,
             ]);
            }
             
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $role=User::where('role','admin');
        if($formation){
            
            $infoFormationValide=$request->validated();
            $formation->nom = $infoFormationValide['nom'];
            $formation->duree = $infoFormationValide['duree'] ;
        if($formation->update()){
            return response()->json([
                'statut'=>1,
                'message'=> 'Formation modifiée avec succès',
            ]);
        }else{
            return response()->json([
                'statut'=>0,
                'message'=> 'Echec modification formation',
            ]);
        }
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $role=User::where('role','admin');
        if($formation){
           
            if($formation->delete()){
                
                    return response()->json([
                        'statut'=>1,
                        'message'=> 'Formation supprimée avec succès',
                    ]);
                }else{
                    return response()->json([
                        'statut'=>0,
                        'message'=> 'Echec Suppression',
                    ]);
                }
        }
    
    }
}
