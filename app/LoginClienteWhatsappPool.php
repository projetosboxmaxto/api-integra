<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginClienteWhatsappPool
 *
 * @package App
*/
class LoginClienteWhatsappPool extends Model
{
    public $timestamps = false;
    protected $table = 'login_cliente_whatsapp_pool';
    protected $fillable = ['id_login_cliente',
'id_materia',
'status',
'data_cadastro',
'data_envio',
'contatos_envio',
'data_materia',
'robo',];
    protected $hidden = [];
    
}
