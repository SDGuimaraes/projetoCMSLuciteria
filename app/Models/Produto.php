<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends RModel
{
    use HasFactory;

    protected $table = 'produtos';
    
    protected $fillable = [
        'nome',
        'foto',
        'valor',
        'descricao',
        'categoria_id'
    ];
    public function categoria(){
        return $this->hasOne(Categoria::class,'categoria_id', 'id');
    }
}
