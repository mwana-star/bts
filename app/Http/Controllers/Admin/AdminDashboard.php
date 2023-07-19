<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Transportation;
use App\Models\EnergyConsumption;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';

        return view('admin.dashboard', [
            'page_title' => $page_title,
        ]);
    }

    public function user()
    {
        $page_title = 'User';

        $users = User::all();

        return view('admin.users', [
            'page_title' => $page_title,
            'users' => $users,
        ]);
    }

    public function viewUser($id)
    {
        $page_title = 'User';

        $user = User::where('id', $id);

        return view('admin.view_user_profile', [
            'page_title' => $page_title,
            'user' => $user,
        ]);
    }

    public function transport()
    {
        $page_title = 'Transport Emissions';

        $transportations = Transportation::all();

        return view('admin.transportation', [
            'page_title' => $page_title,
            'transportations' => $transportations,
        ]);
    }

    public function energy()
    {
        $page_title = 'Energy Emissions';

        $energyConsumption = EnergyConsumption::all();

        return view('admin.energy', [
            'page_title' => $page_title,
            'energyConsumption' => $energyConsumption,
        ]);
    }

}
