<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobPosition;
use App\Support\DefaultPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:' . DefaultPermissions::VIEW_EMPLOYEE, ['only' => ['index', 'show']]);
    //     $this->middleware('can:' . DefaultPermissions::CREATE_EMPLOYEE, ['only' => ['create', 'store']]);
    //     $this->middleware('can:' . DefaultPermissions::UPDATE_EMPLOYEE, ['only' => ['edit', 'update']]);
    //     $this->middleware('can:' . DefaultPermissions::DELETE_EMPLOYEE, ['only' => ['destroy']]);

    // }

    public function index()
    {
        $employees = Employee::with('department', 'position', 'manager')->get();
        return Inertia::render(
            'Employee/List',
            ['employees'=> $employees
            ]
        );
    }

    public function create()
    {
        $employee = Employee::all();

        $departments = Department::all();

        $allEmployees = Employee::all();

        return Inertia::render(
            'Employee/Create',
            [
                'employee'=> $employee,
                'departments'=> $departments,
                'allEmployees'=> $allEmployees,
            ]
        );

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'department_id' => 'required',
            'job_position_id' => 'required',
            'work_mobile' => 'nullable',
            'work_phone' => 'nullable',
            'email' => 'required',
            'manager_id' => 'nullable',
            'coach_id' => 'nullable',
        ]);
        // dd($validated);
        Employee::create($validated);
        // sleep(1);

        return redirect('employees');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();

        $allEmployees = Employee::query()->where('id', '!=', $employee->id)->get();

        return Inertia::render(
            'Employee/Edit',
            [
                'employee' => $employee,
                'departments' => $departments,
                'allEmployees'=> $allEmployees,
            ]
        );
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $employee->name = $request->name;
        $employee->work_mobile = $request->work_mobile;
        $employee->work_phone = $request->work_phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->job_position_id = $request->job_position_id;
        $employee->manager_id = $request->manager_id;
        $employee->coach_id = $request->coach_id;
        $employee->save();
        sleep(1);


        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        $departments = Department::all();

        $allEmployees = Employee::query()->where('id', '!=', $employee->id)->get();

        return Inertia::render(
            'Employee/View',
            [
                'employee' => $employee,
                'departments' => $departments,
                'allEmployees' => $allEmployees,
            ]
        );
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect(route('employees.index'));

    }


    public function filterJobPosition(Request $request)
    {
        $departmentID = $request->get('department_id', 0);

        $positions = JobPosition::query()
            ->where('department_id', $departmentID)
            ->get();

        return $positions;
    }
}
