<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MateriaRadiotvJornal
 *
 * @package App
*/
class MateriaRadiotvJornal extends Model
{
    public $timestamps = false;
    protected $table = 'materia_radiotv_jornal';
    protected $fillable = ['servidor',
                                    'sequencial',
                                    'ano',
                                    'titulo',
                                    'sinopse',
                                    'texto',
                                    'data_insert_materia',
                                    'data_materia',
                                    'hora_inicio',
                                    'hora_fim',
                                    'duracao',
                                    'duracao_segundos',
                                    'id_praca',
                                    'id_veiculo',
                                    'id_emissora',
                                    'id_impacto',
                                    'id_categoria',
                                    'id_exibido',
                                    'id_faixa_horaria',
                                    'valor_referencia',
                                    'id_modulo',
                                    'materia_enviada',
                                    'id_registro_importado',
                                    'tabela_importado',
                                    'alias_importado',
                                    'id_operador',
                                    'banco_importado',
                                    'data_hora_materia',
                                    'sinopse_html',
                                    'texto_html',
                                    'status_atual',
                                    'cita_cliente',
                                    'tags',
                                    'quadrante',
                                    'id_classificacao',
                                    'classificacao',
                                    'classificacao_resultado',
                                    'nao_envia_email',
                                    'destaque',
                                    'com_audio',
                                    'capa',];
    protected $hidden = [];
    
}
