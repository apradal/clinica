<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pacients';

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
        'name',
        'lastname',
        'phone',
        'phone2',
        'nif',
        'email',
        'address',
        'birth_year',
        'insurance'
    ];

    /**
     * Gets record associate to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function record(){
        return $this->hasOne('App\Record');
    }

    /**
     * Get the treatments for the pacient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treatments()
    {
        return $this->hasMany('App\Treatment');
    }
}
