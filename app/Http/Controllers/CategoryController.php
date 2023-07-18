<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct category list page
    public function list(){
        $categories=Category::when(request('key'),function($query){
            $query->where('category_name','like','%'.request('key').'%');
        })
                    ->orderBy('id','desc')
                    ->paginate(4);
                    $categories->appends(request()->all());
        //dd($categories);
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }
    //create category
    public function create(Request $request){
        //dd($request->all());
        $this->categoryValidationCheck($request);
        $data=$this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list')->with(['categorySuccess'=>'Category Created Success']);
    }

    //delete category
    public function delete($id){
        //dd($id);
        Category::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>' category deleted Success']);
    }

    //edit category
    public function edit($id){
        $category=Category::where('id', $id)->first();
        // dd($category->id,$category->category_name);
        return view('admin.category.edit',compact('category'));
    }
    //update category
    public function update( Request $request){
        $id=$request->categoryId;
        //dd($id);
        $this->categoryValidationCheck($request);
        $data=$this->requestCategoryData($request);
        //dd($id,$data);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list')->with(['editSuccess'=>'Edited successfully']);

    }

    //categoryValidationCheck
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' =>'required|unique:categories,category_name,'.$request->categoryId
        ])->validate();
    }

    //request data
    private function requestCategoryData($request){
        return [
            'category_name' =>$request->categoryName
        ];
    }
}
