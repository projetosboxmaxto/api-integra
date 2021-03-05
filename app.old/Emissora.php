<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Emissora
 *
 * @package App
*/
class Emissora extends Model
{
    public $timestamps = false;
    protected $table = 'emissora';
    protected $fillable = ['nome',
'servidor',
'sequencial',
'ano',
'id_veiculo',
'id_registro_importado',
'tabela_importado',
'id_exibido',
'id_forma_cobranca',
'preco_visualizacao',
'banco_importado',
'sigla',
'id_praca',
'preco_revista',
'classificacao',
'id_regiao',
'uf',
'com_stream',
'url_stream_sd',
'url_stream_hd',
'audiencia',
'site',
'modelo_streaming',
'url_stream_sd2',
'url_stream_hd2',
'transcricao_qualidade',
'transcricao_url',
'transcricao_url2',];
    protected $hidden = [];
    
}
