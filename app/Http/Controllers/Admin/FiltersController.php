<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Filters;

class FiltersController extends Controller
{
    public function __construct()
    {
    }

    protected function index()
    {
        $filters = Filters::get();

        return view('admin/filters/index', ['filters' => $filters]);
    }

    protected function filter($name)
    {
        $filter = Filters::where('name', '=', $name)->get()->first();
        if($filter->obj == ''){$filter->obj = '[]';}

        return view('admin/filters/filter', ['filter' => $filter]);
    }

    protected function update($name)
    {
        $input = \Request::all();
        $filter = Filters::where('name', '=', $name)->get()->first();
        $filter->obj = json_encode($input['json']);
        $filter->save();
        return $filter;
    }
}
