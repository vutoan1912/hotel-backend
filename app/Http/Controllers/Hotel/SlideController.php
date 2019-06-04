<?php

namespace App\Http\Controllers\Hotel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;

class SlideController extends Controller
{
    public function set(Request $request){
        $params = $request->all();
        $id = empty($params['id']) ? 0 : $params['id'];
        $status = empty($params['status']) ? 0 : $params['status'];

        if(is_null($id) || empty($id)){
            return [
                'message' => 'data input null or empty. Require data field id!',
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
        $result = Slide::where('status', 1)->orderBy('updated_at', 'desc')->paginate($limit);
        return $result;
    }
}
