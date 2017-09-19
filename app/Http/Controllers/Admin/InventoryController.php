<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {   
        
    }
    public function create()
    {
        return view('dashboard.admin.inventory.create');
    }
    
    public function store()
    {
        
    }
}
