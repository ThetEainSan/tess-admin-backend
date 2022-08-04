<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DB;
use Hash;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::all();
        return view('employee.index',['employees' => $employees]);
    }

    public function create(){
        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        $states = DB::table('addresses')
                        ->where('type', 'state')
                        ->orderBy('id')
                        ->get();

        return view('employee.create', ['nrc_numbers' => $nrc_numbers, 'states' => $states]);
    }

    public function getTownship(Request $request)
    {
        $state_id = $request->state_id;
        $city_and_townships = DB::table('addresses')
                                    ->where('code', 'like', "$state_id%")
                                    ->where('type', 'township')
                                    ->get();
        return response()->json($city_and_townships);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:employees|email',
            'type' => 'required',
            'phone' => 'required|unique:employees',
            'nrc_no' => 'required',
            'nrc_location' => 'required',
            'nrc_type' => 'required',
            'nrc_number' => 'required',
            'password' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $destinationPath = 'img/employee';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

       $validated['password'] = Hash::make($validated['password']);
       $employee = Employee::Create($validated);
       $employee->avatar = $profileImage;
       $employee->save();

       return redirect('employees')->with('success', 'Employee Created Successfully!');
    }

    public function edit(Request $request){
        $employee = Employee::find($request->id);

        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        $states = DB::table('addresses')
                        ->where('type', 'state')
                        ->orderBy('id')
                        ->get();

        return view('employee.edit', ['employee' => $employee, 
                                        'nrc_numbers' => $nrc_numbers,
                                        'states' => $states,
                                        ]);
    }

    public function update(Request $request){
        $employee = Employee::findOrFail($request->id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'type' => 'required',
            'phone' => 'required',
            'nrc_no' => 'required',
            'nrc_location' => 'required',
            'nrc_type' => 'required',
            'nrc_number' => 'required',
            'password' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $employee->name = $validated['name'];
        $employee->email = $validated['email'];
        $employee->type = $validated['type'];
        $employee->phone = $validated['phone'];
        $employee->nrc_no = $validated['nrc_no'];
        $employee->nrc_location = $validated['nrc_location'];
        $employee->nrc_type = $validated['nrc_type'];
        $employee->nrc_number = $validated['nrc_number'];
        $employee->address = $validated['address'];
        $employee->state = $validated['state'];
        $employee->city = $validated['city'];

        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $destinationPath = 'img/employee';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            if($employee->avatar == ''){
                $image->move($destinationPath, $profileImage);
                $employee->avatar = $profileImage;
            }else {
                DeleteImage($destinationPath, $employee->avatar);
                $image->move($destinationPath, $profileImage);
                $employee->avatar = $profileImage;
            }
        }
        $employee->save();

        return redirect('employees')->with('success', 'Employee Edited Successfully !');
    }

    public function delete(Request $request){
        $employee = Employee::findOrFail($request->id);
        $destinationPath = 'img/employee';
        DeleteImage($destinationPath, $employee->avatar);
        $employee->delete();
    
        return redirect('employees')->with('success', 'Employee Deleted Duccessfully!');
    }
}
