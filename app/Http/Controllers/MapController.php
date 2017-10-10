<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MapController extends Controller
{

    /**
     * 获取相似位置
     *
     * @param Request $request
     * @return string
     */
    public function getSimilarity(Request $request)
    {
        $mapJson = file_get_contents('http://apis.map.qq.com/ws/place/v1/suggestion/?keyword=' . $request->input('keyword') . '&key=EOWBZ-23M3S-FHWOP-6H5NO-3BVO5-ENBTR');
        return $mapJson;
    }

}
