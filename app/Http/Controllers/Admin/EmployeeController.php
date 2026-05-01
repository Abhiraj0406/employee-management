<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeProfile;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = EmployeeProfile::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.employees.index', compact('employees'));
    }

    public function show(EmployeeProfile $employeeProfile)
    {
        $employeeProfile->load(['user', 'educations']);

        return view('admin.employees.show', compact('employeeProfile'));
    }
}
