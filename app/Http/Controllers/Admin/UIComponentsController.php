<?php

namespace App\Http\Controllers\Admin;

use App\UIComponents;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UIComponentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function show($name)
    {
        $uicomponent = UIComponents::where('name','=',$name)->get()->first();

        if(isset($uicomponent) && count($uicomponent)){
            $uicomponent_arr = $uicomponent->toArray();
            if(is_array($uicomponent_arr) && isset($uicomponent_arr['obj'])){
                $obj = json_decode($uicomponent_arr['obj'], true);
                if(!isset($obj['images'])){
                    $uicomponent_arr['images'] = json_encode([]);
                }else{
                    $uicomponent_arr['images'] = json_encode($obj['images']);
                }
            }
        }else{
            $uicomponent_arr['name'] = $name;
            $uicomponent_arr['obj'] = json_encode([]);
            $uicomponent_arr['images'] = json_encode([]);
        }

        return view('admin/ui-components/ui-component', ['uicomponent' => $uicomponent_arr]);
    }

    public function update()
    {
        $input = \Request::all();

        if(!isset($input['images'])){
            $input['images'] = [];
        }
        if ($input['name'] && is_array($input['images'])) {
            $uicomponent = UIComponents::firstOrCreate(['name' => $input['name']]);
            if (isset($uicomponent)) {
                if(isset($uicomponent->obj)){
                    $arr = json_decode($uicomponent->obj, true);
                }else{
                    $arr = [];
                }
                $arr['images'] = $input['images'];
                $uicomponent->obj = json_encode($arr);
                $uicomponent->update();
            } else {
                dd('error occured while creating new model');
            }
        }
        return 'ui-component is updated';
    }
}
