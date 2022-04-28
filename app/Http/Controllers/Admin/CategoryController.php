<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdatePostFormRequest;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $category = Category::indexmodel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.category.index')
            ->with('category', $category);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        try {
            $group = Groups::indexmodel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.category.create')
            ->with('group', $group);
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
        $data['group_id'] = $request->input('group_id');
        $data['url'] = $request->input('url');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');

        $hasfileimage = $request->hasFile('image');
        $image = $request->file('image');
        $data['status'] = $request->input('status');

        try {
            Category::storemodel($data, $hasfileimage, $image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Category added Successfully.');
    }

    /**
     * edit
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function edit(Request $request, $id)
    {
        if (empty($id)) {
            return NULL;
        }
        try {
            $group = Groups::indexmodel();
            $category = Category::editmodel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.category.edit')
            ->with('group', $group)
            ->with('category', $category);
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
        $data['group_id'] = $request->input('group_id');
        $data['url'] = $request->input('url');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');

        $hasfileimage = $request->hasFile('image');
        $image = $request->file('image');
        $data['status'] = $request->input('status');
        try {
            Category::updatemodel($id, $data, $hasfileimage, $image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Category Updated Successfully.');
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
            Category::deletemodel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Category Deleted Successfully.');
    }
}
