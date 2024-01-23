<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class Dashboard extends Controller
{
    public function index(){
      $article=Article::all()->count();
        return view('back.dashboard',compact('article'));
    }
}
