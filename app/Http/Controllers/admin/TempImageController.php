<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Intervention\Image;

class TempImageController extends Controller
{
    public function create(Request $request){
        $image = $request->image;
        if(!empty($image)){
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            $temImage = new TempImage();
            $temImage->name = $newName;
            $temImage->save();

            $image->move(public_path().'/temp',$newName);

            //generting thumbnaill
            $sPath = public_path().'/temp/'.$newName;
            $dPath = public_path().'/temp/thumb/'.$newName;
            $image = Image::make($sPath);
            $image->fit(300,275);
            $image->save($dPath);

            return response()->json([
                'status' => true,
                'image_id' => $temImage->id,
                'ImagePath' => asset('/temp/thumb/'.$newName),
                'message' => 'image upload successfully'
            ]);
        }
    }
}
