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

    protected function filter($id)
    {
        $filter = Filters::where('id', '=', $id)->get()->first();

        if (!isset($filter['obj']) || $filter['obj'] == ''){
            $filter['obj'] = '[]';
        }

        return view('admin/filters/filter', ['filter' => $filter]);
    }


    protected function update($id = null)
    {
//        dd($_POST['json']);

//        $input = \Request::all();
//        return $input['json'];
//        return json_decode($input['json'], 1, 10000);
        $input = \Request::all();

        if(isset($input['name'])) {
            $input['name'] = trim($input['name']);
        }

        if(isset($input['json'])) {
            $input['json'] = json_decode($input['json'], 1, 10000);
        }

        if (isset($id)){
            $filter = Filters::where('id', '=', $id)->get()->first();
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

            return \Redirect::action('Admin\FiltersController@filter', ['id' => $filter->id]);
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
