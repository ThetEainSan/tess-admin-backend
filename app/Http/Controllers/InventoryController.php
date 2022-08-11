<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function foodIndex(){
        $foods = Inventory::where('FOD', 'foods')->get();

        return view('inventory.indexFood', ['foods' => $foods]);
    }

    public function foodCreate(){
        return view('inventory.createFood');
    }

    public function foodStore(Request $request){
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'series' => 'required',
            'type' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);
        if ($request->file('image')) {
            $image = $request->file('image');
            $destinationPath = 'img/food';
            $foodImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $foodImage);
        }

       $food = Inventory::Create($validated);
       $food->image = $foodImage;
       $food->FOD = 'foods';
       $food->save();

       return redirect('foods')->with('success', 'Food Created Successfully!');
    }

    public function foodEdit(Request $request){
        $food = Inventory::find($request->id);

        return view('inventory.editFood', ['food' => $food]);
    }

    public function foodUpdate(Request $request){
        $food = Inventory::findOrFail($request->id);
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
}
