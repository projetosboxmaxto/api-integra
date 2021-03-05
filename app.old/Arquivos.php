<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Arquivos
 *
 * @package App
*/
class Arquivos extends Model
{
    public $timestamps = false;
    protected $table = 'arquivos';
    protected $fillable = ['id_materia',
'servidor',
'sequencial',
'ordem',
'nome',
'tamanho',
'tipo',
'id_tipo',
'data_cadastro',
'duracao',
'duracao_segundos',
'id_associado',
'codigo',
'ano',
'tabela',
'thumb',
'flv_file',
'url_drive',];
    protected $hidden = [];
    
}
