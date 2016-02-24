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
                if(!isset($obj['html'])){
                    $uicomponent_arr['html'] = '';
                }else{
                    $uicomponent_arr['html'] = $obj['html'];
                }
                if(!isset($obj['configuration'])){
                    $uicomponent_arr['configuration'] = '';
                }else{
                    $uicomponent_arr['configuration'] = $obj['configuration'];
                }
                unset($uicomponent_arr['obj']);
            }
        }else{
            $uicomponent_arr['name'] = $name;
            $uicomponent_arr['images'] = json_encode([]);
            $uicomponent_arr['html'] = '';
            $uicomponent_arr['configuration'] = '';
        }

        return view('admin/ui-components/ui-component', ['uicomponent' => $uicomponent_arr]);
    }

    public function update()
    {
        $input = \Request::all();

        if(isset($input['name']) && $input['name'] != '') {
            $uicomponent = UIComponents::firstOrCreate(['name' => $input['name']]);
            if (isset($uicomponent)) {
                if (isset($uicomponent['obj'])) {
                    $arr = json_decode($uicomponent->obj, true);
                } else {
                    $arr = [];
                }
                if (isset($input['images'])) {
                    $arr['images'] = $input['images'];
                    $uicomponent->obj = json_encode($arr);
                    $uicomponent->update();

                    return \Redirect::action('Admin\UIComponentsController@show',['name' => $uicomponent->name]);

                } elseif (isset($input['html'])) {
                    $arr['html'] = $input['html'];
                    $uicomponent->obj = json_encode($arr);
                    $uicomponent->update();

                    return \Redirect::action('Admin\UIComponentsController@show',['name' => $uicomponent->name]);

                } elseif (isset($input['configuration'])) {
                    $arr['configuration'] = $input['configuration'];
                    $uicomponent->obj = json_encode($arr);
                    $uicomponent->update();

                    return \Redirect::action('Admin\UIComponentsController@show',['name' => $uicomponent->name]);

                } else {
                    return 'error: invalid data received';
                }
            } else {
                return 'error: ui-component with the name ' . $input['name'] . ' either does not exist or cannot be created';
            }
        } else {
            return 'error: ui-component name is not received';
        }

    }
}
