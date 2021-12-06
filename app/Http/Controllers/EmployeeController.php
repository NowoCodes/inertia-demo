<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    public function index()
    {
        return inertia('Employees/Index', [
            'department_id' => Request::get('department_id'),
            'employees' => Employee::orderBy('id', 'DESC')
                ->with('department')
                ->whereDepartment(Request::get('department_id'))
                ->get()
                ->transform(function ($employee) {
                    return [
                        'id' => $employee->id,
                        'name' => $employee->name,
                        'email' => $employee->email,
                        'department' => $employee->department->name ?? null,
                    ];
                }),

            'departments' => function () {
                return Department::orderBy('name')->get()
                    ->transform(function ($d) {
                        return [
                            'id' => $d->id,
                            'label' => $d->name,
                        ];
                    });
            },
        ]);
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get()
            ->transform(function ($d) {
                return [
                    'id' => $d->id,
                    'label' => $d->name,
                ];
            });

        return inertia('Employees/Create', [
            'departments' => $departments,
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
            'departments' => Department::orderBy('name')->get()
                ->transform(function ($d) {
                    return [
                        'id' => $d->id,
                        'label' => $d->name,
                    ];
                }),
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