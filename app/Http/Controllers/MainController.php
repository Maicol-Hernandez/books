<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;

class MainController extends Controller
{

    public function index(Request $request)
    {
        // DB::connection()->enableQueryLog();
        dump($request->all());
        return view('welcome')->with([
            'books' => Book::all(),
            'categories' => Category::all()->pluck('name', 'id')
        ]);
    }
}
