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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //$users = $this->_userModel::where([['id', '=', Auth::user()->getAttribute('id')]])->get();
        return view('admin.user.index');
    }
}