<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CadastroBasico
 *
 * @package App
*/
class CadastroBasico extends Model
{
    public $timestamps = false;
    protected $table = 'cadastro_basico';
    protected $fillable = ['descricao',
'tipo_cadastro_basico',
'servidor',
'ano',
'sequencial',
'tipo',
'id_registro_importado',
'tabela_importado',
'campo1',
'campo2',
'campo3',];
    protected $hidden = [];
    
}
