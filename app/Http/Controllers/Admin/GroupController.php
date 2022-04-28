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
            $group = Groups::indexmodel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.groups.index')->with('group', $group);
    }

    /**
     * viewpage
     *
     * @return void
     */
    public function viewpage()
    {
        try {
            return view('admin.collection.groups.create');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
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
        if ($request->input('status') == true) {
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        try {

            Groups::storemodel($data);
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
            return NULL;
        }
        try {
            $group = Groups::editmodel($id);
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
            return NULL;
        }
        $data = [];
        $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['descrip'] = $request->input('descrip');
        $data['status'] = $request->input('status') == true ? '1' : '0';
        try {
            Groups::updatemodel($id, $data);
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
            return NULL;
        }
        try {
            Groups::deletemodel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Group Data Deleted Successfully');
    }
}
