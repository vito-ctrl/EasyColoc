<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'colocation_id' => 'required|exists:colocations,id',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'colocation_id' => $request->colocation_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'category created.');
    }
}
