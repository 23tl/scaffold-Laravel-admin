<?php


namespace App\Http\Controllers\Admin;


use App\Logic\TagLogic;
use Illuminate\Http\Request;

class TagsController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, TagLogic $logic)
    {
        parent::__construct($request);
        $this->logic = $logic;
    }

    public function index()
    {

    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function edit(int $id)
    {

    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
