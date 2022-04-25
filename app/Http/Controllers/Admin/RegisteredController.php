<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UpdatePostFormRequest;

class RegisteredController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {

        try {
            $users = User::indexmodel();
            return view('admin.users.index')->with('users', $users);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        try {
            $user_roles = User::editmodel($id);
            return view('admin.users.edit')->with('user_roles', $user_roles);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * updaterole
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updaterole(Request $request, $id)
    {

        try {
            $data = [];
            $data['name'] = $request->input('name');
            $data['roles'] = $request->input('roles');
            $data['isban'] = $request->input('isban');
            User::updatemodel($id, $data);
            return redirect()->back()->with('status', 'Action is updated');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {

        try {
            User::deletemodel($id);
            return redirect()->back()->with('status', 'Category Deleted Successfully.');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }
}
