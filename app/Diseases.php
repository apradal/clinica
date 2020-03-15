<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diseases extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'diseases';

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
        'heart',
        'heart_description',
        'osteoporosis',
        'osteoporosis_description',
        'liver',
        'liver_description',
        'cancer',
        'cancer_description',
        'kidney',
        'kidney_description',
        'hiv',
        'hiv_description',
        'lung',
        'lung_description',
        'hepatitis',
        'hepatitis_description',
        'diabetes',
        'diabetes_description',
        'circulatory',
        'circulatory_description',
        'others_description',
    ];

    /**
     * Gets record associate to the disease.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record(){
        return $this->belongsTo('App\Record');
    }
}
