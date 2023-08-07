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
        $query = null;
        $books = Book::all();
        if ($request->has('category_id')) {
            $books = $books->where('category_id', $request->category_id);
            $query['category_id'] = $request->category_id;
        }

        return view('welcome')->with([
            'books' => $books,
            'categories' => Category::all()->pluck('name', 'id'),
            'query' => $query,
        ]);
    }
}
