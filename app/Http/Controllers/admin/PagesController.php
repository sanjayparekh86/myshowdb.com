<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index(){

        $page = Page::latest()->get();
        $data['page'] = $page;
        return view('admin.pages.list', $data);
    }

    public function create($id = null){
        $page = $id ? Page::findOrFail($id) : null;
        $data['page'] = $page;
        return view('admin.pages.create', $data);
    }

    public function createorUpdate(Request $request, $id = null){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => $id ? 'required|unique:pages,slug,' . $id : 'required|unique:pages',
            'content' => 'required'
        ]);

        if ($validator->passes()) {
            if ($id) {
                $page = Page::findOrFail($id);
            } else {
                $page = new Page;
            }

            $page->name = $request->input('name');
            $page->slug = $request->input('slug');
            $page->content = $request->input('content');
            $page->save();

            return response()->json([
                'status' => true,
                'message' => $id ? 'Page updated successfully' : 'Page created successfully',
                'data' => $page,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request){
        $page = $id ? Page::findOrFail($id) : null;

        if (empty($page)) {
            return response()->json([
                'status' => false,
                'message' => 'Page not Found'
            ]);
        }

        $page->delete();

        return response()->json([
            'status' => true,
            'message' => 'Page Deleted Successfully.'
        ]);
    }
}
