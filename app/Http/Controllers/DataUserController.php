<?php
namespace App\Http\Controllers;

use App\DataTables\DataUserDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index(DataUserDataTable $dataTable)
    {
        $title = 'Data User';
        return $dataTable->render('admin.DataUser', compact('title'));
    }

    public function add()
    {
        $title = 'Tambah User';
        return view('admin.dataUser-add', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('data_user')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = 'Edit User';
        $user = User::findOrFail($id);
        return view('admin.DataUser-edit', compact('title', 'user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = User::findOrFail($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('data_user')->with('success', 'User berhasil diperbarui');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('data_user')->with('success', 'User berhasil dihapus');
    }
}

