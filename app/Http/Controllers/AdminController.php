<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('modules.change_password.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = $request->user();

        $request->validate([
            'current_password' => [
                'required',
                function ($attr, $value, $fail) use ($admin) {
                    if (!Hash::check($value, $admin->password)) {
                        return $fail(__('The current password is not correct.'));
                    }
                }
            ],
            'password'  => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->back()->with('success', 'Success!! Password has been changed.');
    }
}
