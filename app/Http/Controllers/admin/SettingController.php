<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::latest()->first();
        $data['setting'] = $setting;
        return view('admin.setting.setting', $data);
    }

    public function createorUpdate(Request $request, $id = null){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->passes()) {
            if ($id) {
                $setting = Setting::findOrFail($id);
            } else {
                $setting = new Setting;
            }

            $setting->name = $request->input('name');
            $setting->email = $request->input('email');
            $setting->save();

            return response()->json([
                'status' => true,
                'message' => $id ? 'Setting updated successfully' : 'Setting created successfully',
                'data' => $setting,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
