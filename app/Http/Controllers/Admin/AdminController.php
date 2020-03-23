<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 15/03/2020
 * Time: 10:42
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.admin');
    }
}