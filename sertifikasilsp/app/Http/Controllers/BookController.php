<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian
        $search = $request->input('search');

        // Filter data berdasarkan pencarian
        $books = Book::with('categories') // Mengambil data buku beserta kategorinya
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('categories', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%"); // Filter berdasarkan kategori
                    });
            })
            ->get();

        return view('pages.book.index', compact('books'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.book.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_date' => 'required|date',
            'categories.*' => 'exists:categories,id',
        ]);

        $book = Book::create($request->only(['title', 'author', 'publisher', 'published_date']));

        if ($request->has('categories')) {
            $book->categories()->attach($request->categories); // Menyimpan relasi kategori
        }

        return redirect()->route('buku.index')->with('success', 'Book created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return view('pages.book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        // Temukan buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Ambil semua kategori dari database
        $categories = Category::all(); // Pastikan model Category ada

        // Kirim data buku dan kategori ke view
        return view('pages.book.edit', compact('book', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title,' . $id,
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_date' => 'required|date',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
            'status' => 'required|in:available,unavailable', // Validasi status
        ]);

        // Temukan buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Perbarui data buku
        $book->update($request->only(['title', 'author', 'publisher', 'published_date', 'status']));

        // Perbarui kategori jika diperlukan
        $book->categories()->sync($request->category_id);

        return redirect()->route('buku.index')->with('success', 'Book updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('buku.index')->with('success', 'Book deleted successfully.');
    }
}
