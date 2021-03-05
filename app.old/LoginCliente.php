<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginCliente
 *
 * @package App
*/
class LoginCliente extends Model
{
    public $timestamps = false;
    protected $table = 'login_cliente';
    protected $fillable = ['nome',
                                'login',
                                'senha',
                                'tipo',
                                'ativo',
                                'email',
                                'ano',
                                'servidor',
                                'sequencial',
                                'modulos',
                                'status',
                                'idtablet',
                                'agrupamento',
                                'email_attc_msg',
                                'cod_cliente',
                                'nome_cliente',
                                'layout_email',
                                'id_exibido',
                                'id_monitoramento_scup',
                                'feed_configuravel',];
    protected $hidden = [];
    
}
