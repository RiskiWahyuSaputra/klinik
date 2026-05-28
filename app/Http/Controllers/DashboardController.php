<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'doctor':
                return redirect()->route('doctor.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            case 'patient':
            default:
                return redirect()->route('patient.dashboard');
        }
    }
}
