<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @package App
*/
class Cliente extends Model
{
    public $timestamps = false;
    protected $table = 'cliente';
    protected $fillable = ['nome',
'servidor',
'ano',
'sequencial',
'id_registro_importado',
'tabela_importado',
'banco_importado',
'fantasia',
'cpf_cnpj',
'telefone',
'fax',
'status',
'id_pai',
'site',
'template_html',
'login',
'senha',
'id_tipo',
'id_modelo_email',
'modulos_email',
'mostra_mensuracao',
'id_regiao',
'label_classes',
'mostra_relatorio',
'id_monitoramento_scup',
'mostra_so_prioridade',
'online_calculo_valor_banner',
'online_calculo_largura_banner',
'online_calculo_altura_banner',
'online_calculo_valor_caractere',
'data_ultima_edicao_dicionario',
'ativo',];
    protected $hidden = [];
    
}
