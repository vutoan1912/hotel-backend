<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;

class AboutController extends Controller
{
    public function data(Request $request){
        $params = $request->all();
        $image = empty($params['image']) ? null : $params['image'];
        $description = empty($params['description']) ? null : $params['description'];
        $content = empty($params['content']) ? null : $params['content'];

        $model = new About;
        $model->image = $image;
        $model->description = $description;
        $model->content = $content;
        $model->created_at = date('Y-m-d H:i:s');
        $model->created_by = 1;
        $result = $model->save();
        return json_encode($result);
    }

    public function get(Request $request){
        $result = About::orderBy('id', 'desc')->first();
        if($result){
            $result->image = env("DOMAIN") . $result->image;
        }
        return $result;
    }
}
