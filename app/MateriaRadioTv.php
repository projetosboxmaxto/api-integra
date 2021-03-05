<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MateriaRadioTv
 *
 * @package App
*/
class MateriaRadioTv extends Model
{
    public $timestamps = false;
    protected $table = 'materia_radio_tv';
    protected $fillable = ['id_programa',
'id_apresentador',
'indicar_programa',
'fixar_programacao',
'nr_registro_importado',];
    protected $hidden = [];
    
}
