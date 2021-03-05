<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssociacaoCadastros
 *
 * @package App
*/
class AssociacaoCadastros extends Model
{
    public $timestamps = false;
    protected $table = 'associacao_cadastros';
    protected $fillable = ['id_pai',
'tabela_pai',
'tipo_pai',
'id_filho',
'tabela_filho',
'tipo_filho',
'classificacao',
'sequencial',
'ano',
'servidor',
'tabela_importado',
'banco_importado',
'id_registro_importado',
'data_referencia'];
    protected $hidden = [];
    
}
