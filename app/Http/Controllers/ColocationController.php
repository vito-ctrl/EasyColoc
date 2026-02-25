<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ColocationController extends Controller
{
    public function create()
    {
        return view('colocations.create');
    }

    public function show(Colocation $colocation)
    {
        $colocation->load('members');

        return view('colocations.show', compact('colocation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

    //     Colocation::create([
    //         'name' => $request->name,
    //         'owner_id' => auth()->id(),
    //     ]);

    //     return redirect()->route('dashboard')->with('success', 'Colocation created.');
    // }

    // public function invite(Request $request, Colocation $colocation)
    // {
    //     $request->validate([
    //         'email' => 'required|email|exists:users,email',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     // Prevent inviting a user who already belongs
    //     if ($colocation->members()->where('user_id', $user->id)->exists()) {
    //         return back()->with('error', 'User already in this colocation.');
    //     }

    //     $token = Str::uuid(); // unique token

    //     $colocation->members()->attach($user->id, [
    //         'status' => 'pending',
    //         'token' => $token,
    //     ]);

    //     // Send email (simplified using Laravel Mail)
    //     Mail::raw(
    //         "You have been invited to join colocation '{$colocation->name}'. Accept here: " . route('colocations.accept', $token),
    //         function ($message) use ($user) {
    //             $message->to($user->email)
    //                     ->subject('Invitation to join colocation');
    //         }
    //     );

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

}
