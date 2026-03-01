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

    public function create($colocation_id) {

        $colocation = Colocation::find($colocation_id);

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

        $colocation = Colocation::findOrFail($request->colocation_id);
        $members = $colocation->activeMembers()->get();

        $count = $members->count();

        if ($count > 0) {
            $share = round($amount / $count, 2);

            foreach ($members as $member) {
                $depense->users()->attach($member->id, [
                    'share' => $share,
                ]);
            }
        }

        return back()->with('success', 'Colocation created.');
    }
}
