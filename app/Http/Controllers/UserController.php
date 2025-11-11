<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Pagination: default 10
        $perPage = $request->input('per_page', 10);
        $perPage = in_array($perPage, [5, 10, 20]) ? $perPage : 10;

        $users = User::orderBy('id', 'asc')->paginate($perPage)->withQueryString();

        return view('users.index', compact('users', 'perPage'));
    }
}
