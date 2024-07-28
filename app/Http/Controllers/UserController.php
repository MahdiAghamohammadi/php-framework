<?php

namespace App\Http\Controllers;
class UserController extends Controller
{
    public function index()
    {
        echo "UserController index";
    }

    public function create()
    {
        echo "UserController create";
    }

    public function store()
    {
        echo "UserController store";
    }

    public function show($id)
    {
        echo "UserController show";
    }

    public function edit($id)
    {
        echo "UserController edit";
    }

    public function update($id)
    {
        echo "UserController update";
    }

    public function destroy($id)
    {
        echo "UserController destroy";
    }
}