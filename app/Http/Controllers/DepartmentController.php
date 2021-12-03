<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function store(Request $request)
    {
        Department::create(
            Request::validate([
                'name' => ['required', 'min:5', 'max:50'],
                'email' => ['nullable', 'email', 'max:50'],
                'phone' => ['nullable', 'max:50'],
            ])
        );

        return Redirect::route('departments.index');
    }

    public function show(Department $department)
    {
        //
    }

    public function edit(Department $department)
    {
        //
    }

    public function update(Request $request, Department $department)
    {
        //
    }

    public function destroy(Department $department)
    {
        //
    }
}
