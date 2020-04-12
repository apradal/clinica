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
use App\Treatment;

class PatientController extends Controller
{
    /** @var \App\Patient Patient */
    protected $_patientModel;

    /** @var \App\Treatment $_treatmentModel */
    protected $_treatmentModel;

    /**
     * PatientController constructor.
     * @param Patient $patientModel
     * @param Treatment $treatmentModel
     */
    public function __construct(
        Patient $patientModel,
        Treatment $treatmentModel
    ) {
        $this->_patientModel = $patientModel;
        $this->_treatmentModel = $treatmentModel;
    }

    /**
     * Load admin pacient or redirect.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->input('id')) {
            try {
                $data = $this->_patientModel->loadPatientWithRecords($request->input('id'));
                return view('admin.patient.index')->with($data);
            } catch (\Exception $e) {
                return redirect()->route('admin')->withErrors($e->getMessage());
            }
        } else {
            return redirect()->route('admin');
        }
    }

    /**
     * Save treatment by ajax.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTreatmentAjax(Request $request)
    {
        if ($request->input('patient_id')) {
            $params = $request->all();

            $currentPatient = $this->_patientModel->find($params['patient_id']);
            try {
                if ($currentPatient->id) {
                    $this->_treatmentModel->patient()->associate($currentPatient);
                    $treatment = $this->_treatmentModel->fill($params);
                    if ($treatment->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Tratamiento guardado correctamente',
                            'id' => $treatment->getAttribute('id')
                        ]);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Error al guardar tratamiento']);
                    }
                } else {
                    return response()->json(['success' => false, 'message' => 'El id del tratamiento no existe']);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => true], 500);
    }

    /**
     * deletes treatment by ajax.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTreatmentAjax(Request $request)
    {
        if ($request->input('id') && $request->ajax()) {
            $params = $request->all();

            /** @var \App\Patient $currentPatient */
            $currentPatient = $this->_patientModel->find($params['patient_id']);
            try {
                if ($currentPatient->getAttribute('id')) {
                    if ($currentPatient->treatments()->find($params['id'])->delete()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Tratamiento eliminado correctamente',
                        ]);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Error al eliminar tratamiento']);
                    }
                } else {
                    return response()->json(['success' => false, 'message' => 'El id del tratamiento no existe']);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => true], 500);
    }

    /**
     * Edit Treatment by ajax
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editTreatmentAjax(Request $request)
    {
        if ($request->input('id') && $request->input('patient_id') && $request->ajax()) {
            $params = $request->all();

            /** @var \App\Patient $currentPatient */
            $currentPatient = $this->_patientModel->find($params['patient_id']);
            if ($currentPatient->getAttribute('id')) {
                $treatment = $currentPatient->treatments()->find($params['id']);
                if ($treatment->getAttribute('id')) {
                    foreach ($params as $key => $value) {
                        if ($key === 'id' || $key === 'patient_id') continue;
                        $treatment->setAttribute($key, $value);
                    }
                }
                if ($treatment->save()) {
                    return response()->json(['success' => true, 'message' => 'Tratamiento editado correctamente']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Error al editar tratamiento']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'El id del tratamiento no existe']);
            }
        }

        return response()->json(['error' => true], 500);
    }

    /**
     * Edit patient by ajax
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editPatientAjax(Request $request)
    {
        if ($request->input('id') && $request->ajax()) {
            $params = $request->all();

            /** @var \App\Patient $currentPatient */
            $currentPatient = $this->_patientModel->find($params['id']);
            if ($currentPatient->getAttribute('id')) {
                foreach ($params as $key => $value) {
                    if ($key === 'id') continue;
                    $currentPatient->setAttribute($key, $value);
                }
                if ($currentPatient->save()) {
                    return response()->json(['success' => true, 'message' => 'Paciente editado correctamente']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Error al editar paciente']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'El id del paciente no existe']);
            }
        }

        return response()->json(['error' => true], 500);
    }

    /**
     * Index page for search patients
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function search()
    {
        try {
            return view('admin.patient.search');
        } catch (\Exception $e) {
            return redirect()->route('admin')->withErrors($e->getMessage());
        }
    }

    /**
     * Get patients by ajax.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchAjax(Request $request)
    {
        if ($request->ajax()) {
            $params = $request->all();
            $result = $this->_patientModel->searchByFilter($params);

            if ($result->count()) {
                return response()->json(['success' => true, 'patients' => $result->get()->all()]);
            } else {
                return response()->json(['success' => false]);
            }
        }

        return response()->json(['error' => true], 500);
    }
}