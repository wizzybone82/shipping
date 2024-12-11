<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Show admin dashboard if authenticated
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            
            $title = 'Dashboard';
            return view('admin.dashboard',compact('title'));
        } else {
            return redirect()->route('admin.create')->withErrors('You must log in first.');
        }
    }

    // Login form (dummy placeholder for now)
    public function create()
    {
        if (Auth::guard('admin')->check()){
            return redirect()->route('admin.index');
        }
        $title = 'Login';
        return view('admin.login',compact('title'));
    }

    // Login admin
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index'); // Redirect to the dashboard
        }

        return back()->withErrors('Invalid credentials');
    }

    // Logout admin
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.create'); // Redirect to login form
    }

    // Not implemented resource methods
    public function show($id) { return response()->json(['error' => 'Not implemented'], 405); }
    public function edit($id) { return response()->json(['error' => 'Not implemented'], 405); }
    public function update(Request $request, $id) { return response()->json(['error' => 'Not implemented'], 405); }
}
