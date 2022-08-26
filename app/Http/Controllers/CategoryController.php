<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Config, Validator;

class CategoryController extends Controller
{
    public function __construct() { 
        $this->rp = Config::get('app.result_per_page');
    }

    public function index() {
        $categorys = Category::paginate($this->rp);
        return view('category/index', compact('categorys'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
            $categorys = Category::where('id', 'like', '%'.$query.'%')
            ->orWhere('name', 'like', '%'.$query.'%')
            ->paginate($this->rp);
        } 
        else {
            $categorys = Category::paginate($this->rp);
        }
        return view('category/index', compact('categorys'));
    }

        // Insert
        public function insert(Request $request) {
            // create a new category
            $category = new Category();
            $category->name = $request->name;
            $category->id = count(Category::all())+1;
            $category->save();                
    
            return redirect('category')
            ->with('ok', true)
            ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
        }

    public function edit($id = null) {
        if($id) {
            // edit view
            $category = Category::where('id', $id)->first(); return view('category/edit')
            ->with('category', $category);
        }else{
             // add view
             return view('category/add');
        }

    }

    public function update(Request $request){
        $rules = array(
            // 'id' => 'required|numeric', 
            'name' => 'required',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
        );
            
        $id = $request->id;
        $temp = array(
            'name' => $request->name, 
            // 'id' => $request->id,
        );

        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('category/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $category = Category::find($id);
        $category->name = $request->name;

        $category->save(); 

        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function remove($id) {
        Category::find($id)->delete();
        
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
