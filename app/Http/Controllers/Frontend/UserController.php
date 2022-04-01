<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;
use App\Models\Product;
use App\Models\Order;

class UserController extends Controller
{
    public function myprofile(){
        return view('frontend.user.profile');
    }

    public function myorder($id){
        $order = Order::where('user_id','=',$id)->get();
        return view('frontend.user.order')
        ->with('order',$order);
    }

    public function profileupdate(Request $request){
        $user_id=Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->name = $request->input('name');
        $user->lname = $request->input('lname');

        if($request->hasFile('image')){
            $destination='uploads/profile/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/profile/',$filename);
            $user->image=$filename;
        }

        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pincode = $request->input('pincode');
        $user->phoneno = $request->input('phoneno');

        $user->update();
        return redirect()->back()->with('status','Profile Updated');
    }

    public function SearchautoComplete(Request $request){
        $query = $request->get('term','');
        $products = Product::where('name','LIKE','%'.$query.'%')->where('status', '0')->get();
        $data = [];
        foreach ($products as $items) {
            $data[] = [
                 'value'=>$items->name,
                'id'=>$items->id
            ];
        }
        if(count($data))
        {
            return $data;
        }
        else
        {
            return ['value'=>'No Result Found','id'=>''];
        }
    }

    public function result(Request $request){
        $searchingdata = $request->input('search_product');
        $products = Product::where('name','LIKE','%'.$searchingdata.'%')->where('status','0')->first();
            if($products)
            {
                if(isset($_POST['searchbtn']))
                {
                    return redirect('collection/'.$products->subcategory->category->group->url.'/'.
                    $products->subcategory->category->url.'/'.$products->subcategory->url);
                }
                else
                {
                    return redirect('collection/'.$products->subcategory->category->group->url.'/'.
                    $products->subcategory->category->url.'/'.$products->subcategory->url.'/'.$products->url);
                }
            }
            // return redirect('search/'.$products->url);
            else{
                return redirect('/')->with('status', 'Product Not Available');
            }
    }

}
