<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0  && Auth::user()->email_verified_at != NULL) {
                $users = User::all();
                return view('users.index', compact('users'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function create()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0  && Auth::user()->email_verified_at != NULL) {
                return view('users.create');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function store(Request $request)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0  && Auth::user()->email_verified_at != NULL) {
                $request->validate([
                    'user_type' => 'required|in:0,1,2,3',
                    'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
                    'email' => 'email',
                    'password' => ['required', Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(5)],
                    'admin_password' => 'required|current_password'
                ]);
                $user = new User();
                $user->user_type = $request->user_type;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->email_verified_at = now();
                if ($request) {
                    $user->save();
                    return back()->with('success', "");
                }
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function edit($id)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0  && Auth::user()->email_verified_at != NULL) {
                $user = User::find($id);
                return view('users.edit', compact('user'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function update(Request $request, $id)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0  && Auth::user()->email_verified_at != NULL) {
                $request->validate([
                    'user_type' => 'required|in:0,1,2,3',
                    'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
                    'email' => 'email',
                    'password' => ['required', Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(5)],
                    'admin_password' => 'required|current_password'
                ]);
                $user = User::find($id);
                $user->user_type = $request->user_type;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->email_verified_at = now();
                if ($request) {
                    $user->save();
                    return back()->with('success', "");
                }
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0  && Auth::user()->email_verified_at != NULL) {
                $user = User::find($id);
                $request->validate([
                    'password' => 'required|current_password'
                ]);
                if ($request) {
                    $user->delete();
                    return back()->with('deleted', "");
                } else {
                    return back()->with('failed', "");
                }
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
}
