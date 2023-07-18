<?php

namespace App\Http\Controllers;
use Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

        //admin change password page
        public function changePasswordPage(){
            return view('admin.account.changePassword');
        }
        //admin change password
        public function changePassword(Request $request){
           // dd($request->all());
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
        //admin direct detail page
        public function details(){
            return view('admin.account.detail');
        }
        //derect admin profile page
        public function edit(){
            return view('admin.account.edit');
        }
        //update profile
        public function update($id, Request $request){
           // dd($id,$request->all());
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
           return redirect()->route('admin#details')->with('upAccountSuccess','Account is updated');
        }

        //admin accounts lists
        public function list(){
            $admins=User::when(request('key'),function($query){
                $query->orWhere('name','like','%'.request('key').'%')
                        ->orWhere('email','like','%'.request('key').'%')
                        ->orWhere('gender','like','%'.request('key').'%')
                        ->orWhere('phone','like','%'.request('key').'%')
                        ->orWhere('address','like','%'.request('key').'%')
                        ->orWhere('created_at','like','%'.request('key').'%');
            })->where('role','admin')->paginate(3);
            $admins->appends(request()->all());
           // dd($admin->toArray());
            return view('admin.account.list',compact('admins'));
        }


        //admin list delete with route url Id
        public function delete($id){
            //dd('delete',$id);
            User::where('id',$id)->delete();
            return redirect()->route('admin#list')->with('adminDelete','admin delete Success');
        }
        //delete user with Ajax another way
        public function deleteUser(Request $request){
        //logger($request->all());
        User::where('id', $request->userId)->delete();
        return redirect()->route('admin#list')->with('adminDelete','admin delete Success');
        }


        //admin change role page
        public function changeRole(Request $request){
        //logger($request->all());
        $upData = ['role' => $request->role];
        User::where('id', $request->userId)->update($upData);
        return redirect()->route('admin#list')->with('changeRole','role Changed Success');
        }


        //accoutn validation check
        private function accountValidationCheck($request){
            Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'image'=>'mimes:jpeg,png,webp,jpg|file',
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
                'conformPassword'=>'required|min:6',
            ],[
                'oldPassword.required'=>'wrong old password',
                'newPassword.required'=>' new password is required',
                'conformPassword.required'=>'wrong old password'
            ])->validate();
        }
}
