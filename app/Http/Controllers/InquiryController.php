<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\InquirySubmitted;
use App\Mail\ThankyuMail;

class InquiryController extends Controller
{
    public function index()
    {
        return view('front.inquiry.inquiry');
    }

    public function inquirySubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
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


            $recipientEmail = Setting::first()->email;
            Mail::to($recipientEmail)->send(new InquirySubmitted($inquiry));

            // Send the thank-you email to the user
            Mail::to($request->email)->send(new ThankyuMail($inquiry));

            return response()->json([
                'status' => true,
                'message' => 'Inquiry Received'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
