<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function index()
    {
        return inertia('Employees/Index', [
            'employees' => Employee::latest()->with('department')->paginate(10),
        ]);
    }

    public function create()
    {
        $department = Department::get();

        return inertia('Employees/Create', [
            'department' => $department,
        ]);
    }

    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());

        return Redirect::route('employees.index')->with('success', 'Employee Created Successfully');
    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit(Employee $employee)
    {
        return inertia('Employees/Edit', [
            'employee' => [
                'id' => $employee->id,
                'department_id' => $employee->department_id,
                'name' => $employee->name,
                'email' => $employee->email,
            ],
        ]);
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return Redirect::route('employees.index')->with('success', 'Employee Updated Successfully');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return Redirect::route('employees.index')->with('success', 'Employee Deleted');
    }
}