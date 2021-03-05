<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginClienteWhatsappPoolLog
 *
 * @package App
*/
class LoginClienteWhatsappPoolLog extends Model
{
    public $timestamps = false;
    protected $table = 'login_cliente_whatsapp_pool_log';
    protected $fillable = ['id_login_cliente',
'id_materia',
'id_pool',
'id_login_cliente_registro',
'data_envio',];
    protected $hidden = [];
    
}
