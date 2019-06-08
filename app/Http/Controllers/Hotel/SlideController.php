<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;

class SlideController extends Controller
{
    public function set(Request $request){
        //$params = $request->all();
        $params = json_decode($request->getContent(), true);
        $id = empty($params['id']) ? null : $params['id'];
        $status = is_null($params['status']) ? null : $params['status'];

        if(is_null($id) || empty($id)){
            return [
                'message' => 'data input null or empty. Require data field id!',
                'code' => 0
            ];
        }
        if(is_null($status)){
            return [
                'message' => 'data input null or empty. Require data field status!',
                'code' => 0
            ];
        }
        Slide::where('id', $id)->update(['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
        return [
            'message' => 'update slide status success',
            'code' => 1
        ];
    }

    public function get(Request $request){
        $params = $request->all();
        $limit = empty($params['limit']) ? 3 : $params['limit'];
        $status = empty($params['status']) ? -1 : $params['status'];
        if($status > -1)
            $result = Slide::where('status', $status)->orderBy('updated_at', 'desc')->paginate($limit);
        else
            $result = Slide::orderBy('updated_at', 'desc')->paginate($limit);
        return $result;
    }
}
