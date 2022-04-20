<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Requests\UpdatePostFormRequest;
  
class UserController extends Controller
{
    public function myprofile(){
        try{
            return view('frontend.user.profile');
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
           }
    }

    public function myorder($id){
       try{
           $order = Order::myordermodel($id);
        return view('frontend.user.order')
        ->with('order',$order);
       }
       catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }
 
    public function profileupdate(UpdatePostFormRequest $request){
        
       try{ 
            $data = [];
            $data['name'] = $request->input('name');
            $data['lname'] = $request->input('lname');

            $hasFileimage = $request->hasFile('image');    
            $image=$request->file('image');

            $data['address'] = $request->input('address');
            $data['city'] = $request->input('city');
            $data['state'] = $request->input('state');
            $data['pincode'] = $request->input('pincode');
            $data['phoneno'] = $request->input('phoneno');

            Order::profileupdatemodel($data,$hasFileimage,$image);
            return redirect()->back()->with('status','Profile Updated');
        }
        catch (\Exception $exception) {
            return view('errors.error_show');
           }
    }

    public function SearchautoComplete(Request $request){
       try{
           $query = $request->get('term','');
        $products = Product::searchautocomplete($query);
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
      catch (\Exception $exception) {
        return view('errors.error_show');
       }
    }

    public function result(Request $request){
       try{
           $searchingdata = $request->input('search_product');
        $products = Product::searchautoresult($searchingdata);
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
        catch (\Exception $exception) {
            return view('errors.error_show');
           }
    }

}
