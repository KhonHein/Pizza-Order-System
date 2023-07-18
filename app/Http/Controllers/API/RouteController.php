<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\CategoryController;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // API get All product lists
    public function productsList(Request $request){
        $data = $this->getAllData($request);
        return response() ->json($data, 200);
    }

    //post a new category
    public function createCategory(Request $request){
        $data = $this->getCategoryData($request);
        $response = Category::create($data);
        return response()->json($response, 200);
    }
    //delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id', $request->id)->first();
        if(isset($data)){
            Category::where('id', $request->id)->delete();
            $res = [
                'status' => true,
                'message' => 'you deleted successfully '];
            return response()->json($res ,200);
        }else{
            $res = [
                'status' => false,
                'message' => 'there is no data '];
            return response()->json($res ,500);
        }

    }
    // category details
    public function categoryDetails($id){
        //dd($request->all());
        $data = Category::where('id', $id)->first();
        if(isset($data)){
            $res = [
                'status' => true,
                'data' => $data];
            return response()->json($res ,200);
        }else{
            $res = [
                'status' => false,
                'message' => 'there is no data '];
            return response()->json($res ,500);
        }
    }

    //category upcate
    public function categoryUpdate(Request $request){
        $con = Category::where('id', $request->id)->first();
        $data = $this->getCategoryData($request);
        if(isset($con)){
            Category::where('id', $request->id)->update($data);
            $cstegory = Category::where('id', $request->id)->first();
            $response = [
                'status' => 'true',
                'message' => 'Successfully updated',
                'category' => $cstegory
            ];
            return response()->json($response,200);
        }else{

            $response = [
                'status' => 'false',
                'message' => 'there is no data '
            ];
            return response()->json($response,500);
        }
    }

    //create contact
    public function createContact(Request $request){
        $data = $this->getContact($request);
        //dd($data);
        $response = Contact::create($data);
        return response()->json($response, 200);
    }

    //get contact data
    private function getContact($request){
        return [
                'name' =>$request->name,
                'email' =>$request->email,
                'message' =>$request->message,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
        ];
    }
    //get all data
    private function getAllData($request){
        $products = Product::get();
        $categories = Category::get();
        $users = User::get();
        $orders = Order::get();
        $contact = Contact::get();
         return [
            'products' => $products,
            'categories' => $categories,
            'users' => $users,
            'orders' => $orders,
            'contact' => $contact
        ];
    }

    //get category data
    private function getCategoryData($request){
       return [
            'category_name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
