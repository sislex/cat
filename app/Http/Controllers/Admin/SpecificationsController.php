<?php

namespace App\Http\Controllers\Admin;

use App\Specifications;
use App\Http\Controllers\Controller;

class SpecificationsController extends Controller
{
    public function index()
    {
        $specifications = Specifications::orderBy('ord','asc')->get();
        $specification_groups = Specifications::where('parent_id','=',0)->orderBy('ord','asc')->get();

        return view('admin/specifications/index', ['specifications' => $specifications, 'specification_groups' => $specification_groups]);
    }

    public function add($id)
    {
        $specification_groups = Specifications::where('parent_id', '=', 0)->get();

        return view('admin/specifications/specification', ['specification_groups' => $specification_groups, 'spec_parent_id' => $id]);
    }

    protected function specification($id)
    {
        $specification = Specifications::where('id', '=', $id)->get()->first();
        $specification_groups = Specifications::where('parent_id', '=', 0)->get();

        return view('admin/specifications/specification', ['specification' => $specification, 'specification_groups' => $specification_groups, 'spec_parent_id' => $specification['parent_id']]);
    }

    protected function update()
    {
        $input = \Request::all();

        if(isset($input['name'])) {
            $input['name'] = trim($input['name']);
        }

        if (!isset($input['id'])){
//            dd($input);
            Specifications::create($input);
        } else {
            $specification = Specifications::find($input['id']);
            $specification->name = $input['name'];
            $specification->ord = $input['ord'];
            $specification->parent_id = $input['parent_id'];
            $specification->save();
        }

//        return \Redirect::action('Admin\SpecificationsController@specification', ['name' => $specification->name]);
        return \Redirect::action('Admin\SpecificationsController@index');
    }

    public function delete($id)
    {
        $specification = Specifications::find($id);
        if($specification['parent_id'] == 0) {
            Specifications::where('parent_id', '=', $specification['id'])->delete();
        }
        $specification->delete();

        return \Redirect::action('Admin\SpecificationsController@index');
    }

    protected function getJSONByName()
    {
        $input = \Request::all();
        if(isset($input['name'])){
            return Specifications::where('name', '=', $input['name'])->get()->first()->obj;
        }
        else{
            $specifications = Specifications::get();
            $arr = [];
            $i = 0;
            foreach($specifications as $key => $value){
                if($value->parent_id == 0){
                    $arr[$i]['name'] = $value->name;
                    $arr[$i]['children'] = $this->getChildrenByParentId($specifications, $value->id);

                    $i++;
                }
            }

            return $arr;
        }
    }

    protected function getChildrenByParentId($arr, $parent_id){
        $newArr = [];
        foreach($arr as $key => $value){
            if($value->parent_id == $parent_id){
                $newArr[] = $value->name;
            }
        }

        return $newArr;
    }

    protected function getJSONspecifications()
    {
        $specifications = Specifications::select('id','name','parent_id')->get()->toJSON();

        return $specifications;
    }
}
