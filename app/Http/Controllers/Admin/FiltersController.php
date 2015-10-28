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
        $filter = Filters::where('name', '=', $name)->get();

        return view('admin/filters/filter', ['filter' => $filter]);
    }
}
