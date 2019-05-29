<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function get(Request $request){
        $params = $request->all();
        $limit = empty($params['limit']) ? 10 : $params['limit'];
        $result = News::paginate($limit);
        return $result;
    }

    public function getById(Request $request){
        $params = $request->all();
        $id = empty($params['id']) ? 0 : $params['id'];
        $result = News::find($id);
        return $result;
    }

    public function create(Request $request){

        //dd(json_decode($request->getContent(), true));
        $data = json_decode($request->getContent(), true);

        $model = News::create([
            'title'         => $data['title'],
            'image'         => $data['image'],
            'description'   => $data['description'],
            'content'       => $data['content'],
            'created_at'    => date('Y-m-d H:i:s'),
            'created_by'    => 0
        ]);

        return $model;
    }
}
