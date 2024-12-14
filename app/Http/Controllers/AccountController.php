<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('account.index', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/account')->with('success', 'アカウント情報を変更しました。');
    }

    public function password(Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed'
            ]);

            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => '現在のパスワードが正しくありません。']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect('/account')->with('success', 'パスワードを変更しました。');
        }

        return view('account.password');
    }
}


