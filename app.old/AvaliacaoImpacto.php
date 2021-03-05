<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AvaliacaoImpacto
 *
 * @package App
*/
class AvaliacaoImpacto extends Model
{
    public $timestamps = false;
    protected $table = 'avaliacao_impacto';
    protected $fillable = ['id_impacto',
'id_cliente',
'id_materia',
'tabela_materia',
'servidor',
'ano',
'sequencial',
'id_categoria_cliente',
'cita_cliente',
'classificacao',
'classificacao_resultado',
'data_materia',];
    protected $hidden = [];
    
}
