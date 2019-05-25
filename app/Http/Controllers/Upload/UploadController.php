<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        /*$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);*/
        $image = $request->file('file');
        $input['file_name'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('../images');

        \Log::info($destinationPath);

        $image->move($destinationPath, $input['file_name']);
        //$this->postImage->add($input);
        //return $image->getClientOriginalName();
        //return $input['file_name'];
        return array(
            'message' => 'upload success',
            'link' => 'images/' . $input['file_name'],
            'full_link' => env('DOMAIN') . 'images/' . $input['file_name']
        );
    }
}
