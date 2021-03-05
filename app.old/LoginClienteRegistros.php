<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoginClienteRegistros
 *
 * @package App
*/
class LoginClienteRegistros extends Model
{
    public $timestamps = false;
    protected $table = 'login_cliente_registros';
    protected $fillable = ['data_cadastro',
'nome',
'id_login_cliente',
'detalhes',
'tipo',
'sequencial',
'robo',];
    protected $hidden = [];
    
}
