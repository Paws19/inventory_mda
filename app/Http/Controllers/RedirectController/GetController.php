<?php

namespace App\Http\Controllers\RedirectController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function dashboard(){
        return view('homepage.homepage');
    }

    public function loginPage(){
        return view('layout.loginpage');
    }


    public function side_bar(){

        //retrieve the list of items from the database and pass it to the view

        $items = \App\Models\ItemModel::all();
        $category = \App\Models\CategoryModel::all();

        return view('side_menu.item', compact('items', 'category'));
    }


}
