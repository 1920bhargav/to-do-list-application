<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'sales',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
            'alt_menu' => 0,
        ];
        return view('dashboard',$data);
    }

    public function addRole() {
        Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        Role::create(['guard_name' => 'admin', 'name' => 'user']);

        return "roles created";
    }

    public function assignRole() {
        $user = User::find(1);
        $user->assignRole('admin');
        return "admin role assigned successfully";
    }
}
