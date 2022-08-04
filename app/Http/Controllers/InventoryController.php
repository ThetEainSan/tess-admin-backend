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
}
