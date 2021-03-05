<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JornalistaApresentador
 *
 * @package App
*/
class JornalistaApresentador extends Model
{
    public $timestamps = false;
    protected $table = 'jornalista_apresentador';
    protected $fillable = ['nome',
'servidor',
'ano',
'sequencial',
'id_registro_importado',
'tabela_importado',
'banco_importado',
'login',
'senha',
'tipo',
'tx_veiculo',
'tx_exibicao',
'tx_programa',
'influenciador',
'nota',];
    protected $hidden = [];
    
}
