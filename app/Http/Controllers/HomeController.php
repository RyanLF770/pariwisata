<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.dashboard');
    }

    public function show(){
        $users = User::all();

        return view('pages.user-management', compact('users'));
    }

    public function userAdd(){
        return view('pages.user-add');
    }

    // public function userStore(Request $request)
    // {
    //     // Validasi data
    //     $request->validate([
    //         'username' => 'required|max:255|min:2',
    //         'email' => 'required|email|max:255|unique:users,email',
    //         'password' => 'required|min:5|max:255',
    //     ]);

    //     // Simpan data ke database
    //     User::create([
    //         'username' => $request->username,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // Redirect ke halaman manajemen pengguna dengan pesan sukses
    //     return redirect()->route('user.management')->with('success', 'User added successfully.');
    // }

    public function userStore()
    {
        $attributes = request()->validate([
            'username' => 'required|max:255|min:2',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
            // 'terms' => 'required'
        ]);
        $user = User::create($attributes);
        // auth()->login($user);

        return redirect()->route('user.management')->with('success', 'User added successfully.');
    }

    // public function userStore(Request $request)
    // {
    //     // Validasi data
    //     $attributes = $request->validate([
    //         'username' => 'required|max:255|min:2',
    //         'email' => 'required|email|max:255|unique:users,email',
    //         'password' => 'required|min:5|max:255',
    //     ]);

    //     // Hash the password before saving
    //     $attributes['password'] = Hash::make($attributes['password']);

    //     // Simpan data ke database
    //     $user = User::create($attributes);

    //     // Login user otomatis
    //     // auth()->login($user);

    //     // Redirect ke halaman manajemen pengguna dengan pesan sukses
    //     return redirect()->route('user.management')->with('success', 'User added successfully.');
    // }


    public function userDelete($id)
    {
        // Mengambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Menghapus data pengguna
        $user->delete();

        // Redirect ke halaman manajemen pengguna dengan pesan sukses
        return redirect()->route('user.management')->with('success', 'User deleted successfully.');
    }

    public function editUser($id)
    {
        $data = User::find($id);

        return view('pages.user-edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $attributes = $request->validate([
            'username' => ['required', 'max:255', 'min:2'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'level' => ['required', Rule::in(['admin', 'manager', 'client', 'user'])],
        ]);

        // Mengambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Memperbarui data pengguna
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'level' => $request->level,
        ]);

        // Redirect ke halaman manajemen pengguna dengan pesan sukses
        return redirect()->route('user.management')->with('success', 'User updated successfully.');
    }

    public function orders()
    {
        $bookings = Booking::with('user', 'destination', 'transaction')->get();
        return view('pages.orders', compact('bookings'));
    }


}
