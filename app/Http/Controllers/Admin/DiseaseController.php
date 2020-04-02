<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 15/03/2020
 * Time: 16:01
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use App\Diseases;
use App\Record;

class DiseaseController extends Controller
{
    /** @var \App\Patient Patient */
    protected $_patientModel;

    /** @var \App\Diseases Diseases */
    protected $_diseasesModel;

    /** @var \App\Record $_record */
    protected $_record;

    /**
     * DiseaseController constructor.
     * @param Patient $patientModel
     * @param Diseases $diseasesModel
     * @param Record $record
     */
    public function __construct(
        Patient $patientModel,
        Diseases $diseasesModel,
        Record $record
    ) {
        $this->_patientModel = $patientModel;
        $this->_diseasesModel = $diseasesModel;
        $this->_record = $record;
    }

    public function editDiseaseAjax(Request $request)
    {
        if ($request->input('id') && $request->input('record_id') && $request->ajax()) {
            $params = $request->all();

            /** @var \App\Patient $currentPatient */
            $record = $this->_record->find($params['record_id']);
            if ($record->getAttribute('id')) {
                $disease = $record->disease()->find($params['id']);
                if ($disease->getAttribute('id')) {
                    foreach ($params as $key => $value) {
                        if ($key === 'id' || $key === 'record_id') continue;
                        $disease->setAttribute($key, $value);
                    }
                }
                if ($disease->save()) {
                    return response()->json(['success' => true, 'message' => 'Enfermedades editadas correctamente']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Error al editar enfermedades']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'El id de la enfermedad no existe']);
            }
        }

        return response()->json(['error' => true], 500);
    }
}