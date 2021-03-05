<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Programa
 *
 * @package App
*/
class Programa extends Model
{
    public $timestamps = false;
    protected $table = 'programa';
    protected $fillable = ['ano',
						'servidor',
						'sequencial',
						'nome',
						'hora_inicio',
						'hora_fim',
						'hora_inicio_seg',
						'hora_fim_seg',
						'classificacao',
						'id_meio_comunicacao',
						'destaque',
						'custo_pub',
						'id_registro_importado',
						'tabela_importado',
						'banco_importado',
						'duracao_sem_comercial',
						'duracao_sem_comercial_seg',
						'transcricao_ativar',
						'transcricao_tempo_extra_inicio',
						'transcricao_tempo_extra_fim',
						'transcricao_prioridade',
						'transcricao_prioridade_persistente',
						'transcricao_dias',
						'transcricao_tempo_fim_seg',
						'transcricao_tempo_inicio_seg',
						'descr_facil',
						'id_emissora',];
    protected $hidden = [];
    
}
