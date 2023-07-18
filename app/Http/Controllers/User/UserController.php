<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function homePage(){
        $pizzas=Product::orderBy('created_at','desc')->get();
        $category=Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','cart','history'));
    }
    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('user_id', Auth::user()->id)
        ->get();
        //dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $ca){
            $totalPrice += $ca->pizza_price*$ca->qty;
        }
        //dd($cartList);
        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    // user list direct page
    public function userList(){
        $users = User::where('role','user')->paginate(5);
        //dd($users->toArray());
        return view('admin.user.list',compact('users'));
    }

    //admin change Role
    public function changeRole(Request $request){
        //logger($request->all());
        $upData = ['role'=>$request->role];
        User::where('id', $request->userId)->update($upData);
    }
    //user filter
    public function filter($categoryId){
        //dd($categoryId);
        $pizzas=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category=Category::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
       //dd($order);
        return view('user.main.home',compact('pizzas','category','cart','history'));
    }



    //pizza detils
    public function pizzaDetails($id){
        $pizza=Product::where('id',$id)->first();
        $pizzaList=Product::get();
        //dd($pizzaLlist);
        return view('user.main.detail',compact('pizza','pizzaList'));
    }
    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        //dd('Change Password');
        $currentUser=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$currentUser->password;//hash value


        if(Hash::check($request->oldPassword, $dbPassword)){
        // dd('same password');

            $upPassword=['password'=>Hash::make($request->newPassword)];

            User::where('id',Auth::user()->id)->update($upPassword);
            Auth::logout();
            return redirect()->route('admin#loginPage')->with(['successChange'=>'Login with your new password']);
            }else{
            return back()->with(['notMatch'=>'the old password is invalic .Try again']);
        }

    }

        //profile change accoutn
        public function accoutnChangePage(){
            return view('user.profile.account');
        }
        //update profile
        public function accoutnChange(Request $request){
            //dd($request->all());
            $id=Auth::user()->id;
            //dd($id);
            $this->accountValidationCheck($request);
            $upData=$this->getUserData($request);
            if($request->hasFile('image')){
             $dbImage=User::where('id',$id)->first();
             $dbImage=$dbImage->image;

             if($dbImage!=null){
                 Storage::delete('public/'.$dbImage);
             }

             $fileName=uniqid().$request->file('image')->getClientOriginalName();
             //dd($fileName);
             $request->file('image')->storeAs('public',$fileName);
             $upData['image']=$fileName;
            }

           // dd($dbImage);
            User::where('id',$id)->update($upData);
            return redirect()->route('user#home')->with('upAccountSuccess','Account is updated');
         }

         //user history
         public function history(){
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate('5');
        return view('user.main.history',compact('order'));
         }

        //accoutn validation check
        private function accountValidationCheck($request){
            Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'image'=>'mimes:jpeg,png,web,jpg,jfif|file',
                'address'=>'required',
                'gender'=>'required',

            ])->validate();
        }
        //get user account data
        private function getUserData($request){
            return [
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                //'image'=>$request->image,
                'phone'=>$request->phone,
                'gender'=>$request->gender,

            ];
        }
            //passwordValidationCheck
            private function passwordValidationCheck($request){
                Validator::make($request->all(),[
                    'oldPassword'=>'required|min:6',
                    'newPassword'=>'required|min:6',
                    'conformPassword'=>'required|min:6|same:newPassword',
                ],[
                    'oldPassword.required'=>'wrong old password',
                    'newPassword.required'=>' new password is required',
                    'conformPassword.required'=>'wrong old password'
                ])->validate();
            }


}
