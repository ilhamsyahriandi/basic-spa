<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobPositionController extends Controller
{
    public function index()
    {
        $positions = JobPosition::with('department')->get();

        return Inertia::render(
            'JobPosition/List',
            ['positions' => $positions]
        );
    }


    public function show(JobPosition $position)
    {
        $departments = Department::all();
        return Inertia::render('JobPosition/View', [
            'position' => $position,
            'departments' => $departments,

        ]);
    }

    public function create()
    {
        $positions = JobPosition::all();
        $departments = Department::all();
        return Inertia::render('JobPosition/Create', [
            'positions' => $positions,
            'departments' => $departments,

        ]);
    }

    public function store(Request $request)
    {
        JobPosition::create($request->all());
        return redirect('job-positions');
    }

    public function edit(JobPosition $position)
    {
        $departments = Department::all();

        return Inertia::render('JobPosition/Edit', [
            'position' => $position,
            'departments' => $departments,
        ]);

    }

    public function update(Request $request, JobPosition $position)
    {
        $request->validate([
                'name' => 'required',
        ]);

        $position->name = $request->name;
        $position->level = $request->level;
        $position->department_id = $request->department_id;
        $position->description = $request->description;
        $position->save();
        sleep(1);


        return redirect()->route('job-positions.index');
    }

    public function destroy(JobPosition $position)
    {
        $position->delete();

        return redirect(route('job-positions.index'));
    }
}
