<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::orderBy('created_at', 'DESC')->get();
        return view('employee.index', compact('employee'));
    }
    public function create()
    {
        return view('employee.create');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'role' => 'required',
            'salary' => 'required|numeric',
        ];
        if ($request->image != "") {
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('employee.create')->withInput()->withErrors($validator);
        }
        //Insert employee Database
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->save();

        if ($request->image != "") {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/employee'), $imageName);

            $employee->image = $imageName;
            $employee->save();
        }

        return redirect()->route('employee.index')->with('success', 'Employee Added Successfully');
    }
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit', compact('employee'));
    }
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $rules = [
            'name' => 'required|min:5',
            'role' => 'required',
            'salary' => 'required|numeric',
        ];
        if ($request->image != "") {
            $rules['image'] = 'image';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('employee.index')->withInput()->withErrors($validator);
        }
        //Update employee Database

        $employee->name = $request->name;
        $employee->role = $request->role;
        $employee->salary = $request->salary;
        $employee->save();

        if ($request->image != "") {
            File::delete(public_path('uploads/employee/' . $employee->image));
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploads/employee'), $imageName);

            $employee->image = $imageName;
            $employee->save();
        }

        return redirect()->route('employee.index')->with('success', 'Employee Updated Successfully');
    }
    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        File::delete(public_path('uploads/employee/' . $employee->image));
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Employee Deleted Successfully');
    }
}
