<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function get(Request $request){
        $params = $request->all();
        $room_id = empty($params['room_id']) ? 0 : $params['room_id'];
        $orderBy = empty($params['order_by']) ? 'created_at,DESC' : $params['order_by'];
        $orderBy = explode(",", $orderBy);
        $result = Comment::where('room_id', $room_id)->with('user')->orderBy($orderBy[0], $orderBy[1])->get();
        foreach ($result as &$item){
            $item["user"]->password = null;
        }
        return $result;
    }

    public function create(Request $request){

        //dd(json_decode($request->getContent(), true));
        $data = json_decode($request->getContent(), true);

        $model = Comment::create([
            'room_id'       => $data['room_id'],
            'user_id'       => $data['user_id'],
            'title'         => $data['title'],
            'comment'       => $data['comment'],
            'created_at'    => date('Y-m-d H:i:s'),
            'created_by'    => 0
        ]);

        return $model;
    }

    public function update(Request $request){

        //dd(json_decode($request->getContent(), true));
        $data = json_decode($request->getContent(), true);

        $model = Comment::where('id', $data['id'])->update([
            'room_id'       => $data['room_id'],
            'user_id'       => $data['user_id'],
            'title'         => $data['title'],
            'comment'       => $data['comment']
        ]);

        return $model;
    }

    public function delete(Request $request){
        $params = $request->all();
        $id = empty($params['id']) ? 0 : $params['id'];
        Comment::where('id', $id)->delete();
        return $id;
    }
}
