<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SignboardController extends Controller
{
    public function index()
    {
        $employees = Employee::with('department', 'position', 'manager')->get();
        return Inertia::render(
            'Employee/Signboard',
            ['employees'=> $employees
            ]
        );
    }
}
