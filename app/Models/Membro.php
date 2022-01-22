<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    use HasFactory;

    protected $fillable = ['dicaPresente', 'user_id', 'grupoSorteio_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function gruposorteio(){
        return $this->belongsTo(GrupoSorteio::class);
    }
}