<?php

namespace App\Http\Controllers\Panel;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index(Request $request)
    {
        // DB::connection()->enableQueryLog();
        // dd('');
        $books = Book::all();
        return view('welcome', compact('books'));
    }
}
