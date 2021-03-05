<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssociacaoMateriaRadiotvJornal
 *
 * @package App
*/
class AssociacaoMateriaRadiotvJornal extends Model
{
    public $timestamps = false;
    protected $table = 'associacao_materia_radiotv_jornal';
    protected $fillable = ['servidor',
'sequencial',
'ano',
'id_materia_radiotv_jornal',
'id_entidade',
'id_tipo_entidade',
'id_categoria',
'tabela_importado',
'banco_importado',
'id_registro_importado',
'classificacao',
'data_envio_email',
'data_materia',
'id_veiculo',
'id_emissora',];
    protected $hidden = [];
    
}
