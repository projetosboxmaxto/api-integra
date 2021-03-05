<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CadastroFixo
 *
 * @package App
*/
class CadastroFixo extends Model
{
    public $timestamps = false;
    protected $table = 'cadastro_fixo';
    protected $fillable = ['descricao',
'id_tipo_cadastro_fixo',
'campo2',
'campo1',];
    protected $hidden = [];
    
}
