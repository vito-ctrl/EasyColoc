<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;

class DepenseController extends Controller
{
    public function index(){
        return view('depenses.depenses');
    }

    public function create() {

        $colocation = Colocation::find(1); // temporary

        $users = $colocation->activeMembers()->get();

        // dd($users);

        // dd($users->pluck('name', 'id'));

        $categories = $colocation->categories;

        
        return view('depenses.create', compact('users', 'colocation', 'categories'));
    }

    public function store(){

    }
}
