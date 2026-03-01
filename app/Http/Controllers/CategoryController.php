<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Colocation;

class CategoryController extends Controller
{
    public function store(Request $request, Colocation $colocation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation->categories()->create([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Category created successfully.');
    }
}
