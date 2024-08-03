<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
//        echo "Home index";
        $user = new User();

        // insert
        /*$user->insert([
            'name' => 'siavash',
            'email' => 'siavash@gmail.com',
        ]);*/

        // find
        /*$res = $user->find(2);
        var_dump($res->name);*/

        // update
        /*$user->find(3)->update([
            'name' => 'ali',
            'email' => 'ali@gmail.com',
        ]);*/

        // get
        /*$users = $user->get();
        foreach ($users as $user) {
            echo $user->name . "<br/>";
        }*/

        // delete
        /*$user->delete(3);
        $users = $user->get();
        foreach ($users as $user) {
            echo $user->name . "<br/>";
        }*/

        // where
        /*$users = $user->where('id','>', 1)->get();
        foreach ($users as $user) {
            echo $user->name;
            echo "<br/>";
        }*/

        // orderBy
        /*$users = $user->orderBy('id', 'DESC')->get();
        foreach ($users as $user) {
            echo $user->name;
            echo "<br/>";
        }*/

        // limit
        /*$users = $user->limit(0, 2)->get();
        foreach ($users as $user) {
            echo $user->name;
            echo "<br/>";
        }*/
    }
}