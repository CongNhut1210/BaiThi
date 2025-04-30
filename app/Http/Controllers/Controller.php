<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Container\Attributes\Auth;
use Spatie\Permission\Traits\HasRoles;


abstract class Controller
{
public function assignUserRole()
{
    $user = Auth::user();
    $roleName = 'user';

    // Kiểm tra nếu role đã tồn tại trong database:
    if (!Role::where('name', $roleName)->exists()) {
        Role::create(['name' => $roleName]);
    }

    // Gán role cho user:
    $user->assignRole($roleName);

    return redirect()->back()->with('success', 'Vai trò đã được gán thành công!');
}
}
