<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;

class DepenseController extends Controller
{
    public function index(){
        return view('depenses.depenses');
    }

    public function create() {

        $colocation = Colocation::find(1); // temporary

        $users = $colocation->activeMembers()->get();

        $categories = $colocation->categories;

        
        return view('depenses.create', compact('users', 'colocation', 'categories'));
    }

    public function store(Request $request){
        // dd ($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:10000',
            'date' => 'required|date',
            'payer_id' => 'required|exists:users,id',
            'colocation_id' => 'required|exists:colocations,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $depense = Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'payer_id' => $request->payer_id,
            'colocation_id' => $request->colocation_id,
            'category_id' => $request->category_id,
        ]);

        // $depense->members()->attach(auth()->id(), [
        //     'status' => 'active',
        //     'role' => 'owner',
        // ]);

        return redirect()->route('create')->with('success', 'Colocation created.');
    }
}
