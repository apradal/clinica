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
use Illuminate\Support\Facades\Validator;
use App\Patient;
use App\Record;
use App\Diseases;

class RecordController extends Controller
{
    /** @var \App\Patient Patient */
    protected $_patientModel;

    /** @var \App\Record Record */
    protected $_recordModel;

    /** @var \App\Diseases Diseases */
    protected $_diseasesModel;

    /**
     * RecordController constructor.
     * @param Patient $patientModel
     * @param Record $recordModel
     * @param Diseases $diseasesModel
     */
    public function __construct(
        Patient $patientModel,
        Record $recordModel,
        Diseases $diseasesModel
    ) {
        $this->_patientModel = $patientModel;
        $this->_recordModel = $recordModel;
        $this->_diseasesModel = $diseasesModel;
    }

    public function index(Request $request)
    {
        if ($request->old()) {
            return view('admin\record\index')->with($request->old());
        } else {
            return view('admin\record\index');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function newRecord(Request $request)
    {
        $inputs = $request->except('_token');
        $validator = Validator::make($request->all(),$this->_getValidatorRules(),$this->_getValidatorMessages());
        //if validator fails
        if ($validator->fails()){
            return redirect('/admin/record')->withErrors($validator)->withInput($request->except('_token'));
        } else {
            try {
                //create user
                $patient = $this->_patientModel->create($inputs);

                if ($patient->id) {
                    //asociate patient to record
                    $this->_recordModel->patient()->associate($patient);
                    $record = $this->_recordModel->fill($inputs);
                    $record->save();

                    if ($record->id) {
                        //associate diseases to record
                        $this->_diseasesModel->record()->associate($record);
                        $diseases = $this->_diseasesModel->fill($inputs);
                        $diseases->save();
                    }
                }

                return redirect()
                    ->route('patient', ['id' => $patient->id])
                    ->with(['message' => 'Paciente creado con éxito.']);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['Error al crear paciente', $e->getMessage()]);
            }
        }
    }

    protected function _getValidatorRules()
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'nif' => 'required',
            'phone' => 'required',
        ];
    }

    protected function _getValidatorMessages()
    {
        return [
            'name.required' => 'El nombre del paciente es obligatorio',
            'surname.required' => 'Los apellidos del paciente son obligatorio',
            'nif.required' => 'El dni del paciente es obligatorio',
            'phone.required' => 'El teléfono del paciente es obligatorio',
        ];
    }
}