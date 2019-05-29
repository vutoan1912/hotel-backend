<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class UploadAboutConTroller extends Controller
{
    public function upload(UploadRequest $request)
    {
        if(!$request->hasFile('fileName')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowedfileExtension=['pdf','jpg','png'];
        $files = $request->file('fileName');
        $errors = [];

        foreach ($files as $file) {

            $extension = $file->getClientOriginalExtension();

            $check = in_array($extension,$allowedfileExtension);

            if($check) {
                foreach($request->fileName as $mediaFiles) {
                    $media = new Media();
                    $media_ext = $mediaFiles->getClientOriginalName();
                    $media_no_ext = pathinfo($media_ext, PATHINFO_FILENAME);
                    $mFiles = $media_no_ext . '-' . uniqid() . '.' . $extension;
                    $mediaFiles->move(public_path().'/images/', $mFiles);
                    $media->fileName = $mFiles;
                    $media->clientId = $request->clientId;
                    $media->uploadedBy = Auth::user()->id;
                    $media->save();
                }
            } else {
                return response()->json(['invalid_file_format'], 422);
            }

            return response()->json(['file_uploaded'], 200);

        }
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'author' => 'required',
        ]);
        $fileUpload = $request->file('fileUpload');
        $extension = $fileUpload->getClientOriginalExtension();
        Storage::disk('upload')->put($fileUpload->getFilename().'.'.$extension,  File::get($fileUpload));

        return true;
    }

}
