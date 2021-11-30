<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Http\Request;

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
        //
    }

    public function store(Request $request)
    {
        //
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
