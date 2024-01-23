<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use File;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $banner = Banners::latest();
        $banner = $banner->paginate(10);
        return view('admin.banner.list', compact('banner'));
    }

    public function create($id = null)
    {
        $banner = $id ? Banners::findOrFail($id) : null;
        return view('admin.banner.create', compact('banner'));
    }

    public function createOrUpdate(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'subtitle' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->passes()) {
            $imageName = $request->file('image')->getClientOriginalName();


            if ($id) {
                $banner = Banners::findOrFail($id);
            } else {
                $banner = new Banners;
            }

            $banner->title = $request->input('title');
            $banner->subtitle = $request->input('subtitle');
            $banner->link = $request->input('link', '');

            $request->file('image')->storeAs('public/banner-upload/', $imageName);


            // Store only the name in the database
            $banner->image = $imageName;
            $banner->save();


            return response()->json([
                'status' => true,
                'message' => $id ? 'Banner updated successfully' : 'Banner created successfully',
                'data' => $banner,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request)
    {
        // Retrieve the banner record by ID
        $banner = Banners::find($id);

        if (empty($banner)) {
            $request->session()->flash('error', 'category not found');
            return response()->json([
                'status' => true,
                'message' => 'banner not found'
            ]);
            // return redirect()->route('category.index');
        }
        File::delete(public_path() . '/storage/banner-upload/' . $banner->image);

        $banner->delete();
        $request->session()->flash('success', 'banner Delete Successfully');
        return response()->json([
            'status' => true,
            'message' => 'banner Delete Successfully'

        ]);

    }
}
