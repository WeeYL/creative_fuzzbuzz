<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Profile;

use App\Models\User;
use App\Models\ProfileProject;

class CategoryController extends Controller
{
    public function show($category){
        $projects = Project::where([['status','=','live'],
                                    ['category','=',$category]
                                    ])
                                    ->latest()
                                    ->get();
        
        
     
        return view('category',compact('category','projects'));
    }
}