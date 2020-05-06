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
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /** @var User $_userModel */
    protected $_userModel;

    /**
     * UserController constructor.
     * @param User $userModel
     */
    public function __construct(
        User $userModel
    ) {
        $this->_userModel = $userModel;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.user.index');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),$this->_getValidatorRules(),$this->_getValidatorMessages());
        if ($validator->fails()) {
            return response()->json(['error' => true, 'messages' => $validator->messages()]);
        } else {
            $params = $request->all();

            try {
                //Create user
                $user = $this->_userModel->create([
                    'name' => $params['name'],
                    'email' => $params['email'],
                    'role' =>  $params['role'],
                    'password' => Hash::make($params['password'])
                ]);

                if ($user->getAttribute('id')) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Usuario creado correctamente'
                    ]);
                } else {
                    return response()->json(['error' => true, 'message' => 'error al crear usuario']);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => $e->getMessage()]);
            }
        }
    }

    protected function _getValidatorRules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];
    }

    protected function _getValidatorMessages()
    {
        return [
            'name.required' => 'El parámetro nombre es obligatorio',
            'email.required' => 'El parámetro email es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
            'role.required' => 'El parámetro rol es obligatorio'
        ];
    }
}