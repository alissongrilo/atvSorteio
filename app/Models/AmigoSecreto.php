<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmigoSecreto extends Model
{
    use HasFactory;
    
    protected $fillable = ['membro_id', 'membroSorteado_id', 'grupoSorteio_id'];

    public function membro(){
        return $this->belongsTo(Membro::class);
    }
    public function grupoSorteio(){
        return $this->belongsTo(GrupoSorteio::class);
    }
}