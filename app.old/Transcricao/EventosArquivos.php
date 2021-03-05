<?php
namespace App\Transcricao;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EventosArquivos
 *
 * @package App
*/
class EventosArquivos extends Model
{
    
    protected $connection = 'mysql_transcricao';
    protected $table = 'eventos_arquivos';
    protected $fillable = ['path',
						'nome',
						'id_evento',
						'tempo_realizado_minutos',
						'hora_inicio',
						'hora_inicio_seg',
						'inserted_at',
						'texto',
						'json',
						'tipo',
						'meta_dados',
						'id_materia_radiotv_jornal',
						'com_temp_search',
						'titulo',
						'status',
						'bloqueado_por_id',
						'com_elastic_search',
						'meta_dados_elastic'];
						    protected $hidden = [];
    
}
