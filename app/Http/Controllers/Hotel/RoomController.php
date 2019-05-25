<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImages;

class RoomController extends Controller
{
    public function get(Request $request){
        $params = $request->all();
        $limit = empty($params['limit']) ? 10 : $params['limit'];
        $result = Room::with('roomImages')->paginate($limit);
        return $result;
    }

    public function getById(Request $request){
        $params = $request->all();
        $id = empty($params['id']) ? 0 : $params['id'];
        $result = Room::with('roomImages')->find($id);
        return $result;
    }

    public function create(Request $request){

        //https://stackoverflow.com/questions/33005815/laravel-5-retrieve-json-array-from-request

        //dd(json_decode($request->getContent(), true));
        $data = json_decode($request->getContent(), true);

        $model = Room::create([
            'name'          => $data['name'],
            'image'         => $data['image'],
            'description'   => $data['description'],
            'content'       => $data['content'],
            'rate'          => $data['rate'],
            'point'         => $data['point'],
            'created_at'    => date('Y-m-d H:i:s'),
            'created_by'    => 0
        ]);

        foreach ($data['room_images'] as $image){
            RoomImages::create([
                'room_id'       => $model->id,
                'link'          => $image,
                'description'   => '',
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => 0
            ]);
        }

        return $model;
    }

}
