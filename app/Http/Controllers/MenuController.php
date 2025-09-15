<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Method that will pass to the view all the menu items
    public function index() {
        $menuItems = MenuItem::all();
        return view('menu', compact('menuItems'));
    }
}
