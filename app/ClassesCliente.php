<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ClassesCliente
 *
 * @package App
*/
class ClassesCliente extends Model
{
    public $timestamps = false;
    protected $table = 'classes_cliente';
    protected $fillable = ['nome',
'id_cliente',
'servidor',
'ano',
'sequencial',
'id_pai',
'nivel',
'ordem',
'status',
'id_registro_importado',
'tabela_importado',
'ativo',];
    protected $hidden = [];
    
}
