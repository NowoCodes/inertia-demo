<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Department;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Department::class);
    }

    public function index()
    {
        $sortby = Request::get('sortby', 'id');
        if (!in_array($sortby, ['id', 'name', 'email'])) {
            $sortby = 'id';
        }

        $sort = Request::get('sort', 'ASC');
        if (!in_array($sort, ['ASC', 'DESC'])) {
            $sort = 'ASC';
        }

        return Inertia::render('Departments/Index', [
            'departments' => Department::orderBy($sortby, ($sort === 'ASC') ? 'ASC' : 'DESC')->paginate(10)
                ->through(function ($department) {
                    return [
                        'id' => $department->id,
                        'name' => $department->name,
                        'phone' => $department->phone,
                        'email' => $department->email,
                        'can' => [
                            'edit' => auth()->user()->can('update', $department),
                            'delete' => auth()->user()->can('delete', $department),
                        ],
                    ];
                }),
            'sortby' => $sortby,
            'sort' => $sort,
            'can' => [
                'create' => auth()->user()->can('create', Department::class),
            ],
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
