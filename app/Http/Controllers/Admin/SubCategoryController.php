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
            $category = Category::indexmodel();
            $subcategory = SubCategory::indexmodel();
            return view('admin.collection.subcategory.index')
                ->with('subcategory', $subcategory)
                ->with('category', $category);
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
            $category = Category::indexmodel();
            $subcategory = SubCategory::editmodel($id);
            return view('admin.collection.subcategory.edit')
                ->with('subcategory', $subcategory)
                ->with('category', $category);
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

        try {
            $data = [];
            $data['category_id'] =  $request->input('category_id');
            $data['url'] = $request->input('url');
            $data['name'] = $request->input('name');
            $data['description'] = $request->input('description');
            $hasfileimage = $request->hasfile('image');

            $image = $request->file('image');

            $data['priority'] = $request->input('priority');
            $data['status'] = $request->input('status');

            Subcategory::storemodel($data, $hasfileimage, $image);
            return redirect()->back()->with('status', 'Subcategory Saved Successfully');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
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

        try {
            $data = [];
            $data['category_id'] =  $request->input('category_id');
            $data['url'] = $request->input('url');
            $data['name'] = $request->input('name');
            $data['description'] = $request->input('description');
            $hasfileimage = $request->hasfile('image');

            $image = $request->file('image');

            $data['priority'] = $request->input('priority');
            $data['status'] = $request->input('status');

            Subcategory::updatemodel($id, $data, $hasfileimage, $image);

            return redirect('sub-category')->with('status', 'Subcategory Updated Successfully');
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
            SubCategory::deletemodel($id);
            return redirect()->back()->with('status', 'Sub-Category Deleted Successfully.');
        } catch (\Exception $exception) {
            return view('errors.error_show');
        }
    }
}
