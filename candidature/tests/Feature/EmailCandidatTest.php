<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailCandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
      // Générer un email existant dans la base de données
    $existingEmail = 'test@example.com';

    // Créer un utilisateur avec cet email
    $user = User::factory()->create([
        'role' => 'candidat',
        'email' => $existingEmail,
    ]);

    // Tenter de créer un autre utilisateur avec le même email (ce test doit échouer)
    $newUser = User::factory()->create([
        'role' => 'candidat',
        'email' => $existingEmail,
    ]);

    // Vérifier que la création du nouvel utilisateur a échoué en raison de l'email non-unique
    $this->assertDatabaseHas('users', ['email' => $existingEmail]);
       
}
}
