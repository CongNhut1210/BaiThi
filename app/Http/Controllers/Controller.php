<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Container\Attributes\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



abstract class Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, HasRoles;
public function assignUserRole()
{
    $user = Auth::user();
    $roleName = 'user';
    if (!Role::where('name', $roleName)->exists()) {
        Role::create(['name' => $roleName]);
    }
    $user->assignRole($roleName);

    return redirect()->back()->with('success', 'Vai trò đã được gán thành công!');
}
}
