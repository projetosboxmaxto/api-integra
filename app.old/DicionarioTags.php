<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DicionarioTags
 *
 * @package App
*/
class DicionarioTags extends Model
{
    public $timestamps = false;
    protected $table = 'dicionario_tags';
    protected $fillable = ['nome',
'servidor',
'ano',
'sequencial',
'tipo',
'ativo',];
    protected $hidden = [];
    
}
