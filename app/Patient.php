<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;

class Patient extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patients';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The model's default attributes to save.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'phone2',
        'postal_code',
        'location',
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
     * Get the treatments for the patient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treatments()
    {
        return $this->hasMany('App\Treatment');
    }

    /**
     * Returns an array with patient, record and diseasses attributes.
     * @param $id
     * @return array
     * @throws Exception
     */
    public function loadPatientWithRecords($id)
    {
        /** @var \App\Patient $patient */
        $patient = $this::find($id);
        if ($patient->id) {
            /** @var \App\Record $record */
            $record = $patient->record;
            $treatment = $patient->treatments;
            if ($record->id && $treatment) {
                /** @var \App\Diseases $diseases */
                $diseases = $record->disease;
                if ($diseases->id) {
                    return [
                        'patient' => $patient->getAttributes(),
                        'record' => $record->getAttributes(),
                        'diseases' => $diseases->getAttributes(),
                        'treatments' => $treatment
                    ];
                } else {
                    throw new Exception('Error al cargar enfermedades');
                }
            } else {
                throw new Exception('Error al cargar historia');
            }
        } else {
            throw new Exception('Error al cargar paciente');
        }
    }

    /**
     * get results from db by filter.
     * @param $params
     * @return mixed
     */
    public function searchByFilter($params)
    {
        $where = [];
        foreach ($params as $key => $value) {
            if ($key === 'name' || $key === 'surname') {
                $condition = 'like';
                $value = '%' . $value . '%';
            } elseif ($key === 'page' || $key === 'pager') {
                continue;
            } else {
                $condition = '=';
            }
            $where[] = [$key, $condition, $value];
        }

        return $this::where($where)->simplePaginate($params['pager']);
    }

}
