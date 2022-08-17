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
            'price' => 'required',
            'quantity' => 'required',
            'series' => 'required',
            'type' => 'required',
            'category' => 'required',
        ]);

        $food->name = $validated['name'];
        $food->price = $validated['price'];
        $food->quantity = $validated['quantity'];
        $food->series = $validated['series'];
        $food->type = $validated['type'];
        $food->category = $validated['category'];

        if ($request->file('image')) {
            $image = $request->file('image');
            $destinationPath = 'img/food';
            $foodImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            if($food->image == ''){
                $image->move($destinationPath, $foodImage);
                $employee->avatar = $foodImage;
            }else {
                DeleteImage($destinationPath, $food->image);
                $image->move($destinationPath, $foodImage);
                $food->image = $foodImage;
            }
        }
        $food->save();

        return redirect('foods')->with('success', 'Food Updated Successfully !');
    }

    public function foodDelete(Request $request) {
        $food = Inventory::findOrFail($request->id);
        $destinationPath = 'img/food';
        DeleteImage($destinationPath, $food->image);
        $food->delete();
    
        return redirect('foods')->with('success', 'Food Deleted Duccessfully!');
    }

    public function drinkIndex(Request $request){
        $drinks = Inventory::where('FOD', 'drinks')->get();

        return view('inventory.indexDrink', ['drinks' => $drinks]);
    }

    public function drinkCreate(Request $request){
        return view('inventory.createDrink');
    }

    public function drinkStore(Request $request){
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
            $destinationPath = 'img/drink';
            $drinkImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $drinkImage);
        }

       $drink = Inventory::Create($validated);
       $drink->image = $drinkImage;
       $drink->FOD = 'drinks';
       $drink->save();

       return redirect('drinks')->with('success', 'Drink Created Successfully!');
    }

    public function drinkEdit(Request $request){
        $drink = Inventory::find($request->id);

        return view('inventory.editDrink', ['drink' => $drink]);
    }

    public function drinkUpdate(Request $request){
        $drink = Inventory::findOrFail($request->id);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'series' => 'required',
            'type' => 'required',
            'category' => 'required',
        ]);

        $drink->name = $validated['name'];
        $drink->price = $validated['price'];
        $drink->quantity = $validated['quantity'];
        $drink->series = $validated['series'];
        $drink->type = $validated['type'];
        $drink->category = $validated['category'];

        if ($request->file('image')) {
            $image = $request->file('image');
            $destinationPath = 'img/drink';
            $drinkImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            if($drink->image == ''){
                $image->move($destinationPath, $drinkImage);
                $employee->avatar = $drinkImage;
            }else {
                DeleteImage($destinationPath, $drink->image);
                $image->move($destinationPath, $drinkImage);
                $drink->image = $drinkImage;
            }
        }
        $drink->save();

        return redirect('drinks')->with('success', 'Drink Updated Successfully !');
    }

    public function drinkDelete(Request $request){
        $drink = Inventory::findOrFail($request->id);
        $destinationPath = 'img/drink';
        DeleteImage($destinationPath, $drink->image);
        $drink->delete();
    
        return redirect('drinks')->with('success', 'Drink Deleted Duccessfully!');
    }
}
