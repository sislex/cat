<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
    }

    protected function index()
    {
        $new = '�����';
        $filters = '�����ssssssssss';

        return view('admin/index/index', ['filters' => $filters]);
    }
}
