<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list(){
        $pizzas=Product::select('products.*','categories.category_name') //if the names are same  ,'categories.name as category_name'
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);
       // dd($pizzas->toArray());
        return view('admin.products.pizzaList',compact('pizzas'));
    }
    //direct product create Page
    public function createPage(){
        $categories=Category::select('id','category_name')->get();
        //dd($categories);
        return view('admin.products.create',compact('categories'));
    }
    //delte pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess'=>'deleted Success']);
    }
    //pizza edit product
    public function edit($id){
        $pizzas=Product::select('products.*','categories.category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.products.edit',compact('pizzas'));
    }
    //pizza update updatePage
    public function updatePage($id){
        $pizza=Product::where('id',$id)->first();
        $categorie=Category::get();
        return view('admin.products.update',compact('pizza','categorie'));
    }
    //pizza update
    public function update(Request $request){
        //$id=$request->pizzaId;
        $this->productValidationCheck($request,'update');
        $data=$this->requestProductInfo($request);
        //dd($request->file('pizzaImage') );
        if($request->file('pizzaImage') ){
            $oldImageName=Product::where('id',$request->pizzaId)->first();
            $oldImageName=$oldImageName->image;


            Storage::delete('public/'.$oldImageName);

            $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$fileName);
            $data['image'] =$fileName;
        }
       // dd($request->all());
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('products#list')->with(['updateSuccess'=>'updated successfully']);
    }
    //product create
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data=$this->requestProductInfo($request);

        $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;

        Product::create($data);
        return redirect()->route('products#list');
    }



    //products validation check
    private function productValidationCheck($request,$action){
        $validationRules=[
            'pizzaName'=>'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategorie' =>'required',
            'pizzaDescription' =>'required',
            //'pizzaImage' =>'required|mimes:jpg,jpeg,png|file',
            'pizzaPrice' =>'required',
            'pizzaWaitingTime' =>'required',
        ];
        $validationRules['pizzaImage'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png|file':'mimes:jpg,jpeg,png|file';
        //dd($validationRules);
        Validator::make($request->all(),$validationRules)->validate();
    }
    //product request data
    private function requestProductInfo($request){
        return [
            'category_id' =>$request->pizzaCategorie,
            'name' =>$request->pizzaName,
            'description' =>$request->pizzaDescription,
           // 'view_count' =>$request->pizzaViewCount,
           'price' =>$request->pizzaPrice,
           'waiting_time' =>$request->pizzaWaitingTime,
        ];
    }
}
