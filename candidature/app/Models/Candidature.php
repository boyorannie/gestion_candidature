<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;
    protected $fillable = [
        'statut',
        
    ];

    public function Utilisateurs()
    {
        return $this->belongsTo(User::class);
    }
    public function Formation()
    {
        return $this->belongsTo(Formation::class);
    }
    

}
