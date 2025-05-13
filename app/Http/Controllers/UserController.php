<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Plan;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('is-admin', Auth::user())) {
            // @todo, auth validation, currently it is double, see web.php route::middleware(is-admin)
            return redirect('dashboard');
        }

        return Inertia::render('User', [
            'users' => User::with(['domains'])->orderBy('created_at', 'desc')->get()->forPage(1, 25), //
        ]);
    }

    /**
     * Handle user buy experience
     */
    public function buyFeature(User $user, Plan $plan )
    {
        if ($user->id == Auth::user()->id) {
            $user->plan_id = $plan->id;
            $user->save();
            return redirect('/plans');
        }

        return redirect('/');
    }
}
