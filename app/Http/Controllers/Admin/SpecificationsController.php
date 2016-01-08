<?php

namespace App\Http\Controllers\Admin;

use App\Specifications;
use App\Http\Controllers\Controller;

class SpecificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specifications = Specifications::get();
        return view('admin/specifications/index', ['specifications' => $specifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $specification_groups = Specifications::where('parent_id', '=', 0)->get();

        return view('admin/specifications/specification', ['specification_groups' => $specification_groups]);
    }


    protected function specification($name)
    {
        $specification = Specifications::where('name', '=', $name)->get()->first();
        if ($specification['obj'] == ''){
            $specification['obj'] = '[]';
        }

        $specification_groups = Specifications::where('parent_id', '=', 0)->get();

        return view('admin/specifications/specification', ['specification' => $specification, 'specification_groups' => $specification_groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update($name = null)
    {
        $input = \Request::all();
        $input['name'] = trim($input['name']);

        if ($name != null){
            $specification = Specifications::where('name', '=', $name)->get()->first();
//            $specification['obj'] = json_encode($input['json']);
            $specification->save();

            return $specification;
        } else {
            if (!isset($input['id'])){
                $specification = Specifications::create($input);
            } else {
                $specification = Specifications::find($input['id']);
                $specification->name = $input['name'];
                $specification->parent_id = $input['parent_id'];
                $specification->save();
            }

            return \Redirect::action('Admin\SpecificationsController@specification', ['name' => $specification->name]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $specification = Specifications::find($id);
        $specification->delete();

        return \Redirect::action('Admin\SpecificationsController@index');
    }


    protected function getJSONNames()
    {
        $specifications = Specifications::select('name')->get()->toJSON();

        return $specifications;
    }
}
