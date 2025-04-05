<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Lấy tất cả người dùng từ cơ sở dữ liệu
        // Hiển thị danh sách người dùng
        return view('admin.users.index', compact('users'));
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return redirect()->route('users.index')->with('message', 'Role updated successfully!');
    }
}
