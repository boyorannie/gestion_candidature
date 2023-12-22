<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListeCandidatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
         // Récupère un utilisateur existant avec le rôle administrateur 
    $admin = User::where('role', 'admin')->first();

    // Vérifie si un utilisateur administrateur existe dans la base de données
    $this->assertNotNull($admin, 'Aucun admin trouvé dans la base de données.');

    // Authentifie l'utilisateur administrateur
    $this->actingAs($admin);
    $response = $this->get('/api/liste');
    //afficher tous les candidats récupérés à partir de la base de données
        $responseContent = $response->getContent();
        var_dump(json_decode($responseContent, true));
        $response->assertStatus(200);
    }
}
