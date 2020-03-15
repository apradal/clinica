<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'treatments';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'description'
    ];

    /**
     * Gets paceint associate to the treatment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pacient(){
        return $this->belongsTo('App\Pacient');
    }
}
