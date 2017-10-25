<?php

namespace Modelo;

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{

    use SoftDeletes;
    public $timestamps = true;
    protected $dates   = ['eliminado'];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_modificacion';
    const DELETED_AT = 'eliminado';

    protected $guarded = array('id', 'fecha_creacion', 'fecha_modificacion');

    /**
     * Get the name of the "deleted at" column.
     *
     * @return string
     */
    public function getDeletedAtColumn()
    {
        return static::DELETED_AT;
    }
}