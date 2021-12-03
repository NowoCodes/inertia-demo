<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('name')->paginate(10);

        return Inertia::render('Departments/Index', [
            'departments' => $departments,
        ]);
    }

    public function create()
    {
        return inertia('Departments/Create');
    }

    public function store(DepartmentRequest $request)
    {
        Department::create($request->validated());

        return Redirect::route('departments.index')->with('success', 'Department Created Successfully');
    }

    public function show(Department $department)
    {
        //
    }

    public function edit(Department $department)
    {
        return inertia('Departments/Edit', [
            'department' => [
                'id' => $department->id,
                'name' => $department->name,
                'email' => $department->email,
                'phone' => $department->phone,
            ],
        ]);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return Redirect::route('departments.index')->with('success', 'Department Updated Successfully');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return Redirect::route('departments.index')->with('success', 'Department Deleted');
    }
}
