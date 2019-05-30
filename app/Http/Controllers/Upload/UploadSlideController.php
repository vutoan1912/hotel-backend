<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Slide;

class UploadSlideController extends Controller
{
    public function upload(Request $request)
    {
        /*$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);*/
        $image = $request->file('file');
        $input['file_name'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('../images/slides');

        \Log::info($destinationPath);

        $image->move($destinationPath, $input['file_name']);

        $entity = [
            'name' => 'Slide image',
            'image' => 'images/slides/' . $input['file_name'],
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => 0
        ];

        $model = Slide::create($entity);

        return array(
            'message' => 'upload success',
            //'link' => 'images/slides/' . $input['file_name'],
            'link' => $model->image,
            'full_link' => env('DOMAIN') . 'images/slides/' . $input['file_name'],
            'id' => $model->id
        );
    }

}
