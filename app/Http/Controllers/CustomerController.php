<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Config, Validator;
class CustomerController extends Controller
{
    
    public function index() {
        $data_users = User::all();
        return view('customer.index', compact('data_users'));
    }

    public function onAction($id = null) {
        $user = User::find($id);
        return view('customer.edit')
            ->with('user', $user);
    }

    public function onUpdate(Request $body) {
        $id = $body->id;
        $rules = array(
            'name' => 'required',
            'email' => 'required', 
        );
        
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
        );
        
        $temp = array(
            'name' => $body->name,
            'email' => $body->email,
        );
        //ตรงนี้เป็นการนําค่าจากฟอร์ม มาใส่ตัวแปร array temp เพราะ class Validator ต้องการ array
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('customer/action/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($id);
        $user->name = $body->name;
        $user->email = $body->email;
        $user->save();
        return redirect('customer') 
            ->with('ok', true)
            ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }
    
    public function onDelete($id) {
        User::find($id)->delete();
        return redirect('customer')
            ->with('ok', true)
            ->with('msg', 'ลบข้อมูลสำเร็จ');
    }
}
