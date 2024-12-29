<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {


        // Ambil total data dari setiap tabel
        $totalMembers = Member::count();
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalBorrowedBooks = Borrow::count();

        // Mengirim data ke view
        return view('pages.dashboard', compact('totalMembers', 'totalBooks', 'totalCategories', 'totalBorrowedBooks'));
    }
}
