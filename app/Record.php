<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'records';

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
    protected $fillable = [
        'allergies',
        'treatment',
        'patient_id'
    ];

    /**
     * Gets patient associate to the record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    /**
     * Gets diseases associate to the record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function disease(){
        return $this->hasOne('App\Diseases');
    }
}
