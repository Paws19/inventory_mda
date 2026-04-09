<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemModel;
use App\Models\CategoryModel;

class ItemsController extends Controller
{
    
    //Add items 
   public function addItems(Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'condition' => 'required|string|max:255',
        'status' => 'required|string|max:255',
        'assigned_to' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'purchase_date' => 'nullable|date',
        'warranty_expiration_date' => 'nullable|date|after:purchase_date',
        'remarks' => 'nullable|string|max:500',
    ]);

    // Save or find the category first
    $category = CategoryModel::firstOrCreate(['category_name' => $request->input('category')]);

    // Then save the item, linking the category
    $item = new ItemModel();
    $item->item_name = $request->input('name');           // match your DB column name
    $item->category_id = $category->id;              // link category foreign key
    $item->quantity = $request->input('quantity');
    $item->condition = $request->input('condition');
    $item->status = $request->input('status');
    $item->assigned_to = $request->input('assigned_to');
    $item->location = $request->input('location');
    $item->purchase_date = $request->input('purchase_date');
    $item->warranty_expiration_date = $request->input('warranty_expiration_date');
    $item->remarks = $request->input('remarks');
    $item->save();

    return redirect()->back()->with('success', 'Item added successfully!');
}


}
