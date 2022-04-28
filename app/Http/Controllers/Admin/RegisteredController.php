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
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.users.index')
            ->with('users', $users);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (empty($id)) {
            return NULL;
        }
        try {
            $user_roles = User::editmodel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.users.edit')
            ->with('user_roles', $user_roles);
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
        if (empty($id)) {
            return NULL;
        }
        $data = [];
        $data['name'] = $request->input('name');
        $data['roles'] = $request->input('roles');
        $data['isban'] = $request->input('isban');

        try {
            User::updatemodel($id, $data);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Action is updated');
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        if (empty($id)) {
            return NULL;
        }
        try {
            User::deletemodel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Category Deleted Successfully.');
    }
}
