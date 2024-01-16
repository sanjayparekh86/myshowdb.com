<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\InquirySubmitted;

class InquiryController extends Controller
{
    public function index(){
        return view('front.inquiry.inquiry');
    }

    public function inquirySubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);

        if ($validator->passes()) {
            $inquiry = new Inquiry;
            $inquiry->name = $request->name;
            $inquiry->email = $request->email;
            $inquiry->phone = $request->phone;
            $inquiry->message = $request->message;
            $inquiry->save();

            Mail::to('ishantthakkar10@gmail.com')->send(new InquirySubmitted($inquiry));

            return response()->json([
                'status' => true,
                'message' => 'Inquiry Received'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
