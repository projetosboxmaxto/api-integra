<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MateriaRadiotvJornalComplemento
 *
 * @package App
*/
class MateriaRadiotvJornalComplemento extends Model
{
    public $timestamps = false;
    protected $table = 'materia_radiotv_jornal_complemento';
    protected $fillable = ['hash_tags',
'atores',
'clientes_lista',
'servidor',
'sequencial',
'ano',
'data_materia',
'id_modulo',];
    protected $hidden = [];
    
}
