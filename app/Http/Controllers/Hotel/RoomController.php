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
        $orderBy = empty($params['order_by']) ? 'created_at,DESC' : $params['order_by'];
        $orderBy = explode(",", $orderBy);
        $result = Room::with('roomImages')->orderBy($orderBy[0], $orderBy[1])->paginate($limit);
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
            'cost'          => $data['cost'],
            'link'          => $data['link'],
            'reviews'       => $data['reviews'],
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

    public function update(Request $request){

        //https://stackoverflow.com/questions/33005815/laravel-5-retrieve-json-array-from-request

        //dd(json_decode($request->getContent(), true));
        $data = json_decode($request->getContent(), true);

        $model = Room::where('id', $data['id'])->update([
            'name'          => $data['name'],
            'image'         => $data['image'],
            'description'   => $data['description'],
            'content'       => $data['content'],
            'rate'          => $data['rate'],
            'point'         => $data['point'],
            'cost'          => $data['cost'],
            'link'          => $data['link'],
            'reviews'       => $data['reviews']
        ]);

        RoomImages::where('room_id', $data['id'])->delete();

        foreach ($data['room_images'] as $image){
            RoomImages::create([
                'room_id'       => $data['id'],
                'link'          => $image,
                'description'   => '',
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => 0
            ]);
        }

        return $model;
    }

    public function delete(Request $request){
        $params = $request->all();
        $id = empty($params['id']) ? 0 : $params['id'];
        $result = Room::where('id', $id)->delete();
        RoomImages::where('room_id', $id)->delete();
        return $result;
    }

    public function recommend(Request $request){
        $params = $request->all();
        $id = empty($params['id']) ? 0 : $params['id'];
        $limit = empty($params['limit']) ? 3 : $params['limit'];
        $orderBy = empty($params['order_by']) ? 'point,DESC' : $params['order_by'];
        $orderBy = explode(",", $orderBy);
        $result = Room::where('id', '<>', $id)->orderBy($orderBy[0], $orderBy[1])->take($limit)->get();
        return $result;
    }

}
