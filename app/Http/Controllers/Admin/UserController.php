<?php


namespace App\Http\Controllers\Admin;


use App\Logic\UserLogic;
use Illuminate\Http\Request;

class UserController extends AdminController
{
    protected $logic;

    public function __construct(Request $request, UserLogic $logic)
    {
        parent::__construct($request);

        $this->logic = $logic;
    }

    public function index()
    {
        if ($this->request->ajax()) {

        }

        return view('admin.user.index');
    }

    public function edit()
    {

    }

    public function update()
    {

    }
}