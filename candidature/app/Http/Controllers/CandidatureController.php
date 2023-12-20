<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;

class CandidatureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api'); 
    
        $this->middleware('checkAdmin')->only([
            'listeCandidatures', 
            'Accepter', 
            'Refuser', 
            'ListeAcceptes',
            'ListeRefuses'
        ]);
    }

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
    public function store(StoreCandidatureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Candidature $candidature)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidature $candidature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidatureRequest $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
    // public function postuler(Request $request)
    // {
    //     // dd($request);
    //     $request->validate([
    //         'nomformation' => 'required|string|exists:formations,nomformation',
    //     ]);

    //     $user = auth()->user();
    //     $nomFormation = $request->input('nom');

    //     $formation = Formation::where('nom', $nomFormation)->first();

    //     if ($formation) {
    //         if (!$user->candidatures()->where('id_formation', $formation->id)->exists()) {
    //             $candidature = $user->candidatures()->create([
    //                 'id_formation' => $formation->id,
                
    //             ]);

    //             return response(['message' => 'Candidature enregistrée avec succès'], 200);
    //         } else {
    //             return response(['error' => 'Vous avez déjà postulé à cette formation'], 400);
    //         }
    //     } else {
    //         return response(['error' => 'Formation non trouvée'], 404);
    //     }
    // }

    public function postuler (Request $request, Candidature $candidature)
    {
        // dd($request);
        $formation = Formation::findOrFail($request->id_formation);
        $candidature->id_formation = $formation->id;
        $candidature->id_user = Auth::guard()->user()->id;
        $candidature->save();
        return response()->json([
            'message'=>'Candidature enregistrée',
            'formation'=> $candidature,
        ]);
    }

    public function Accepter($id)
    {
        $candidature = Candidature::find($id);
        $candidature->update([
            'statut' => "acceptée"
        ]);
        $candidature->save();
        return response()->json([
            'candidature_acceptee'=>$candidature,
            'status_message'=> "ok"
        ]);
    }

    public function Refuser($id)
    {
        $candidature = Candidature::find($id);
        $candidature->update([
            'statut' => "refusée"
        ]);
        $candidature->save();
        return response()->json([
            'candidature_refusee'=>$candidature,
            'status_message'=> "candidature déclinée"
        ]);
    }

    public function ListeAcceptes()
    {
        $candidature = Candidature::where('statut', 'acceptée')->get();
        return response()->json([
            'Liste Candidatures Acceptées '=>$candidature,
            
        ]);

    }
    public function ListeRefuses()
    {
        $candidature = Candidature::where('statut', 'refusée')->get();
        return response()->json([
            'Liste Candidatures Refusées'=>$candidature,
            
        ]);
        
    }
    public function listeCandidatures()
    {
        $candidature = Candidature::all();
        return response()->json([
            'liste candidatures'=>$candidature,
            
        ]);
    }


}
