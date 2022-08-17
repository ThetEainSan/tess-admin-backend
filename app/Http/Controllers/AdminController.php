<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Auth;
use App\helpers;

class AdminController extends Controller
{
    public function index(){
        $admins = User::where('id', '!=', Auth::user()->id)->get();
        return view('admin.index',['admins' => $admins]);
    }

    public function create(){
        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        $states = DB::table('addresses')
                        ->where('type', 'state')
                        ->orderBy('id')
                        ->get();

        return view('admin.create', ['nrc_numbers' => $nrc_numbers, 'states' => $states]);
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
        // dd($request);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'phone' => 'required|unique:users',
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
            $destinationPath = 'img/admin';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
        }

       $validated['password'] = Hash::make($validated['password']);
       $admin = User::Create($validated);
       $admin->avatar = $profileImage;
       $admin->save();

       return redirect('admins')->with('success', 'Admin Created Successfully!');
    }

    public function edit(Request $request)
    {
        $admin = User::find($request->id);

        $nrc_numbers = DB::table('nrc_prefix')
                            ->orderBy('state_id_en')
                            ->get();

        $states = DB::table('addresses')
                        ->where('type', 'state')
                        ->orderBy('id')
                        ->get();

        return view('admin.edit', ['admin' => $admin, 
                                        'nrc_numbers' => $nrc_numbers,
                                        'states' => $states,
                                        ]);
    }

    public function update(Request $request){
        $admin = User::findOrFail($request->id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
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

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->phone = $validated['phone'];
        $admin->nrc_no = $validated['nrc_no'];
        $admin->nrc_location = $validated['nrc_location'];
        $admin->nrc_type = $validated['nrc_type'];
        $admin->nrc_number = $validated['nrc_number'];
        $admin->address = $validated['address'];
        $admin->state = $validated['state'];
        $admin->city = $validated['city'];

        if ($request->file('avatar')) {
            $image = $request->file('avatar');
            $destinationPath = 'img/admin';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            if($admin->avatar == ''){
                $image->move($destinationPath, $profileImage);
                $admin->avatar = $profileImage;
            }else {
                DeleteImage($destinationPath, $admin->avatar);
                $image->move($destinationPath, $profileImage);
                $admin->avatar = $profileImage;
            }
        }
        $admin->save();

        return redirect('admins')->with('success', 'Admin Edited Successfully !');
    }

    public function delete(Request $request){
        $admin = User::findOrFail($request->id);
        $destinationPath = 'img/admin';
        DeleteImage($destinationPath, $admin->avatar);
        $admin->delete();
    
        return redirect('admins')->with('success', 'Admin Deleted !');
    }

    public function details(Request $request){
        $admin = User::find($request->id);

        return view('admin.detail', ['admin' => $admin]);
    }
}
