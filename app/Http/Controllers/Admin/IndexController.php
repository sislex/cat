<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index()
    {
        $new = 'òåêñò';
        $filters = 'òåêñòssssssssss';

        return view('admin/index/index', ['filters' => $filters]);
    }
}
