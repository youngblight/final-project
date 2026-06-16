<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
   public function welcomePage(){
    return view('welcome_page');
    }
}
