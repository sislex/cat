<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Filters;

class FiltersController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    protected function index()
    {
        $filters = Filters::get();

        return view('admin/filters/index', ['filters' => $filters]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('admin/filters/filter');
    }


    protected function filter($name)
    {
        $filter = Filters::where('name', '=', $name)->get()->first();
        if ($filter['obj'] == ''){
            $filter['obj'] = '[]';
        }

        return view('admin/filters/filter', ['filter' => $filter]);
    }


    protected function update($name = null)
    {
        $input = \Request::all();

        $input['name'] = trim($input['name']);

        if ($name != null){
            $filter = Filters::where('name', '=', $name)->get()->first();
            $filter['obj'] = json_encode($input['json']);
            $filter->save();

            return $filter;
        } else {
            if (!isset($input['id'])){
                $filter = Filters::create($input);
            } else {
                $filter = Filters::find($input['id']);
                $filter->name = $input['name'];
                $filter->type = $input['type'];
                $filter->save();
            }

            return \Redirect::action('Admin\FiltersController@filter', ['name' => $filter->name]);
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
        $filter = Filters::find($id);
        $filter->delete();

        return \Redirect::action('Admin\FiltersController@index');
    }


    protected function getJSONByName()
    {
        $input = \Request::all();
        if(isset($input['name'])){
            return Filters::where('name', '=', $input['name'])->get()->first()->obj;
        }
        else{
            $filter = Filters::get();
            $arr = [];
            $i = 0;
            foreach($filter as $key => $value){
                $i++;
                $arr[$value->name] = json_decode($value->obj, true);
            }

            return $arr;
        }
    }

    protected function getJSONNames()
    {
        $filters = Filters::select('name')->get()->toJSON();

        return $filters;
    }
}
