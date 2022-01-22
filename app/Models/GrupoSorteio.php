<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoSorteio extends Model
{
    use HasFactory;

    protected $fillable = ['dataSorteio', 'valorMinimo', 'valorMaximo', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDataSorteioAttribute($value){
        $this->attributes['dataSorteio'] = implode('-', array_reverse(explode('/', $value)));
    }
    
    public function getDataSorteioAttribute(){
        $dataConvertida = implode('/', array_reverse(explode('-', $this->attributes['dataSorteio'])));
        return $dataConvertida;
    }
}