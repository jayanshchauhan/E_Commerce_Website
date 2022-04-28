<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdatePostFormRequest;

class SubCategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $category = Category::indexModel();
            $subcategory = SubCategory::indexModel();
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.subcategory.index')
            ->with('subcategory', $subcategory)
            ->with('category', $category);
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
            $category = Category::indexModel();
            $subcategory = SubCategory::editModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return view('admin.collection.subcategory.edit')
            ->with('subcategory', $subcategory)
            ->with('category', $category);
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
        $data['category_id'] =  $request->input('category_id');
        $data['url'] = $request->input('url');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $hasfileimage = $request->hasfile('image');

        $image = $request->file('image');

        $data['priority'] = $request->input('priority');
        $data['status'] = $request->input('status');
        try {
            Subcategory::storeModel($data, $hasfileimage, $image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Subcategory Saved Successfully');
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
        $data['category_id'] =  $request->input('category_id');
        $data['url'] = $request->input('url');
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');
        $hasfileimage = $request->hasfile('image');

        $image = $request->file('image');

        $data['priority'] = $request->input('priority');
        $data['status'] = $request->input('status');
        try {
            Subcategory::updateModel($id, $data, $hasfileimage, $image);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect('sub-category')
            ->with('status', 'Subcategory Updated Successfully');
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
            SubCategory::deleteModel($id);
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
        return redirect()
            ->back()
            ->with('status', 'Sub-Category Deleted Successfully.');
    }
}
