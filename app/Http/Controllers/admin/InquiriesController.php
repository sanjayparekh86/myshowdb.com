<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    public function index(Request $request){
        $inquiry = Inquiry::latest()->get();

        if ($request->get('keyword') != "") {
            $inquiry = $inquiry->where('name', 'like', '%' . $request->get('keyword') . '%');
        }


        // $inquiry = $inquiry->paginate();
        $data['inquiry'] = $inquiry;
        // dump($data);
        return view('admin.inquiry.list', $data);
    }

    public function show($id, Request $request){
        $inquiry = Inquiry::find($id);

        if (empty($inquiry)) {
            return redirect()->route('inquiries.index');
        }

        $data['inquiry'] = $inquiry;
        // dump($inquiry);
        return view('admin.inquiry.show', $data);
    }
}
