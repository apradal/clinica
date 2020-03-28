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
        if ($request->input('patient-id')) {
            $params = $request->all();

            $currentPatient = $this->_patientModel->find($params['patient-id']);
            if ($currentPatient->id) {
                $this->_treatmentModel->patient()->associate($currentPatient);
                $treatment = $this->_treatmentModel->fill($params);
                if ($treatment->save()) {
                    return response()->json(['success' => true]);
                } else {
                    return response()->json(['success' => false]);
                }
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

    public function searchAjax(Request $request)
    {
        if ($request->ajax() && $request->input('search_filter') && $request->input('search_data')) {
            $params = $request->all();
            $result = $this->_patientModel->searchByFilter($params);

            if ($result->count()) {
                $content = view('includes.admin.patient..search.tablerow')
                    ->with(['result' => $result->get()->all()])->render();
                return response()->json(['success' => true, 'content' => $content]);
            } else {
                return response()->json(['success' => false]);
            }
        }

        return response()->json(['error' => true], 500);
    }
}