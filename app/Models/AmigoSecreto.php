<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmigoSecreto extends Model
{
    use HasFactory;
    
    protected $fillable = ['participante_id', 'participanteSorteado_id', 'grupoSorteio_id'];

    public function participante(){
        return $this->belongsTo(Participante::class);
    }
    public function grupoSorteio(){
        return $this->belongsTo(GrupoSorteio::class);
    }
}