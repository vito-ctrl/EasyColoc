<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Total users
        $totalUsers = \App\Models\User::count();
        $users = \App\Models\User::get();

        // Total colocations
        $totalColocations = \App\Models\Colocation::count();

        // Active colocations (at least 1 accepted member)
        $activeColocations = \App\Models\Colocation::whereHas('members', function ($q) {
            $q->where('colocation_user.status', 'accepted')
            ->whereNull('colocation_user.left_at');
        })->count();

        // Total accepted memberships
        $totalActiveMembers = \DB::table('colocation_user')
            ->where('status', 'accepted')
            ->whereNull('left_at')
            ->count();

        // Pending invitations
        $pendingInvitations = \DB::table('colocation_user')
            ->where('status', 'pending')
            ->whereNull('left_at')
            ->count();

        // Total expenses (if you have Depense model)
        $totalExpenses = \App\Models\Expense::count();

        // Total money spent
        $totalAmountSpent = \App\Models\Expense::sum('amount');

        // Recent users (last 5)
        $recentUsers = \App\Models\User::latest()->take(5)->get();

        // Recent colocations (last 5)
        $recentColocations = \App\Models\Colocation::latest()->take(5)->get();

        return view('admin.admin', compact(
            'users',
            'totalUsers',
            'totalColocations',
            'activeColocations',
            'totalActiveMembers',
            'pendingInvitations',
            'totalExpenses',
            'totalAmountSpent',
            'recentUsers',
            'recentColocations'
        ));
    }

    public function ban(User $user)
    {
        if ($user->isBanned()) {
            return back()->with('error', 'User is already banned.');
        }

        $user->ban();

        return back()->with('success', 'User has been banned.');
    }

    public function unban(User $user)
    {
        if (!$user->isBanned()) {
            return back()->with('error', 'User is not banned.');
        }

        $user->unban();

        return back()->with('success', 'User has been unbanned.');
    }

}
