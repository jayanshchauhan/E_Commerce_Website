<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Http\Requests\UpdatePostFormRequest;
use Symfony\Component\HttpKernel\DependencyInjection\RemoveEmptyControllerArgumentLocatorsPass;

class GroupController extends Controller
{

    /**
     * show
     *
     * @return void
     */
    public function show()
    {
        return view('admin.dashboard');
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $group = Groups::indexModel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.groups.index')
            ->with('group', $group);
    }

    /**
     * viewpage
     *
     * @return void
     */
    public function viewpage()
    {
        return view('admin.collection.groups.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = [];
        $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['descrip'] = $request->input('descrip');
        $data['status'] = $request->input('status') == true ? '1' : '0';
        try {

            Groups::storeModel($data);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Group Data Added Successfully');
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
            return view('errors.error_show');
        }
        try {
            $group = Groups::editModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.groups.edit')
            ->with('group', $group);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        if (empty($id)) {
            return view('errors.error_show');
        }
        $data = [];
        $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['descrip'] = $request->input('descrip');
        $data['status'] = $request->input('status') == true ? '1' : '0';
        try {
            Groups::updateModel($id, $data);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Group Data Updated Successfully');
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
            return view('errors.error_show');
        }
        try {
            Groups::deleteModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Group Data Deleted Successfully');
    }
}
