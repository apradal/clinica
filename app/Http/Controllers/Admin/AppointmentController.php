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
use App\Appointment;

class AppointmentController extends Controller
{
    /** @var \App\Patient $_patientModel */
    protected $_patientModel;

    /** @var Appointment $_appointmentModel */
    protected $_appointmentModel;

    /**
     * AppointmentController constructor.
     * @param Patient $patientModel
     * @param Appointment $appointmentModel
     */
    public function __construct(
        Patient $patientModel,
        Appointment $appointmentModel
    ) {
        $this->_patientModel = $patientModel;
        $this->_appointmentModel = $appointmentModel;
    }

    public function createAppointmentAjax(Request $request)
    {
        if ($request->input('patient_id')) {
            $params = $request->all();

            $currentPatient = $this->_patientModel->find($params['patient_id']);
            try {
                if ($currentPatient->id) {
                    $this->_appointmentModel->patient()->associate($currentPatient);
                    $appointment = $this->_appointmentModel->fill($params);
                    if ($appointment->save()) {
                        return response()->json([
                            'success' => true,
                            'message' => 'Cita guardada correctamente',
                        ]);
                    } else {
                        return response()->json(['success' => false, 'message' => 'Error al guardar cita']);
                    }
                } else {
                    return response()->json(['success' => false, 'message' => 'El id del paciente no existe']);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
            }
        }

        return response()->json(['error' => true], 500);
    }

    public function getAllAppointmentsAjax(Request $request)
    {
        if ($request->ajax()) {
            $where = [
                ['date', '<=', date("Y-m-d")],
                ['revised', '=', 0]
            ];
            $result = $this->_appointmentModel->getAll($where);

            if ($result->count()) {
                return response()->json(['success' => true, 'appointments' => $result]);
            } else {
                return response()->json(['success' => false]);
            }
        }

        return response()->json(['error' => true], 500);
    }

}