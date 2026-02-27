<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $colocations = $user->colocations()
            ->wherePivot('status', 'accepted')
            ->wherePivotNull('left_at')
            ->withCount([
                'members as active_members_count' => function ($query) {
                    $query->where('colocation_user.status', 'accepted')
                        ->whereNull('colocation_user.left_at');
                }
            ])
            ->get();

        $invitations = $user->colocations()
            ->wherePivot('status', 'pending')
            ->wherePivotNull('left_at')
            ->get();

        return view('dashboard', compact('colocations', 'invitations'));
    }

    public function create()
    {
        return view('colocations.create');
    }

    public function show($id)
    {
        $colocation = Colocation::with('members')->findOrFail($id);

        return view('colocations.show', compact('colocation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $colocation = Colocation::create([
            'name' => $request->name,
            'owner_id' => auth()->id(),
        ]);

        $colocation->members()->attach(auth()->id(), [
            'status' => 'accepted',
            'role' => 'owner',
        ]);

        return redirect()->route('dashboard')->with('success', 'Colocation created.');
    }

    public function invite(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($colocation->members()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'User already in this colocation.');
        }

        $token = Str::uuid();

        $colocation->members()->attach($user->id, [
            'status' => 'pending',
            'token' => $token,
        ]);

        Mail::raw(
            "You have been invited to join colocation '{$colocation->name}'. Accept here: " . route('colocations.accept', $token),
            function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Invitation to join colocation');
        }
        );

        return back()->with('success', 'Invitation sent!');
    }

    public function accept($token)
    {
        $membership = \DB::table('colocation_user')->where('token', $token)->first();

        if (!$membership) {
            return redirect()->route('dashboard')->with('error', 'Invalid token.');
        }

        // Check if the current user matches the invited email (optional, extra security)
        $colocation = Colocation::find($membership->colocation_id);

        $colocation->members()->updateExistingPivot($membership->user_id, [
            'status' => 'accepted',
            'token' => null
        ]);

        return redirect()->route('dashboard')->with('success', "You joined '{$colocation->name}'!");
    }

    public function leave($id)
    {
        $colocation = Colocation::findOrFail($id);
        $user = auth()->user();

        if(!$colocation->members()->where('user_id', $user->id)->exists()){
            abort(403);
        }

        DB::transaction(function() use ($colocation, $user) {
            if($colocation->owner_id == $user->id){
                $newOwner = $colocation->members()
                    ->where('users.id', '!=', $user->id)
                    ->wherePivotNull('left_at')
                    ->orderByDesc('reputation_score')
                    ->first();
                
                if($newOwner){
                    $colocation->owner_id = $newOwner->id;
                    $colocation->save();
                }else{
                    $colocation->delete();
                    return;
                }
            }
        });
        // Example debt check (adjust to your logic)
        $hasDebts = false; // replace with real check

        // Update pivot
        $colocation->members()->updateExistingPivot($user->id, [
            'left_at' => now()
        ]);

        // Adjust reputation
        if ($hasDebts) {
            $user->decrement('reputation_score', 1);
        }
        else {
            $user->increment('reputation_score', 1);
        }

        return redirect()->route('dashboard')->with('success', 'You left the colocation.');
    }
}
