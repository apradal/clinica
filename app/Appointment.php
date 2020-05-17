<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Avoid using default created_at, updated_at columns
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The model's default attributes to save.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'description',
        'patient_id'
    ];

    /**
     * Gets patient associate to the appointment.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    /**
     * Get appointments
     * @param null $where
     * @return Appointment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll($where = null)
    {
        if (is_array($where)) {
            return $this::where($where)->with('patient')->orderBy('date', 'DESC')->get();
        } elseif ($where) {
            return $this::all()->where($where)->with('patient');
        } else {
            return $this::all()->with('patient');
        }
    }

}
