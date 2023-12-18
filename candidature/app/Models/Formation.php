<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'duree',
    ];

    public function Utilisateurs(): HasMany
    {
        return $this->HasMany(User::class);
    }
    public function Candidature(): HasMany
    {
        return $this->HasMany(Candidature::class);
    }
    

}
