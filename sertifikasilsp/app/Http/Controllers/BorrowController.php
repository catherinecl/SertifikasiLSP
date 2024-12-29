<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowController extends Controller
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
    
        // Query data peminjaman dengan relasi ke member dan book
        $borrows = Borrow::with(['member', 'book'])
            ->when($search, function ($query, $search) {
                $query->whereHas('member', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('book', function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                });
            })
            ->get();
    
        // Kirim data ke view
        return view('pages.borrow.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        $members = Member::all();
        return view('pages.borrow.create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
           'borrow_date' => 'required|date|after_or_equal:today',
            'due_date' => 'required|date|after:borrow_date',
        ]);

        // Cek apakah buku tersedia
        $book = Book::findOrFail($request->book_id);
        if ($book->status !== 'available') {
            return redirect()->back()->withErrors(['book_id' => 'The selected book is currently unavailable.']);
        }

        // Menyimpan data peminjaman buku
        Borrow::create($request->all());

        // Mengubah status buku menjadi 'unavailable'
        $book->update(['status' => 'unavailable']);

        // Redirect kembali ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('pinjam.index')->with('success', 'Book borrowed successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $borrow = Borrow::with('book', 'member')->findOrFail($id);
        return view('borrow.show', compact('borrow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $borrow = Borrow::findOrFail($id);
        $books = Book::where('status', 'available')
                ->orWhere('id', $borrow->book_id)
                ->get(); // Ambil hanya buku yang tersedia atau buku yang sedang dipinjam
        $members = Member::all(); // Ambil data member
        return view('pages.borrow.edit', compact('borrow', 'books', 'members'));
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
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'due_date' => 'required|date|after:borrow_date',
        ]);

        // Menyimpan pembaruan data peminjaman
        $borrow = Borrow::findOrFail($id);

        // Jika buku diganti, ubah status buku lama ke 'available'
        if ($borrow->book_id != $request->book_id) {
            $oldBook = Book::find($borrow->book_id);
            if ($oldBook) {
                $oldBook->update(['status' => 'available']);
            }

            // Ubah status buku baru ke 'unavailable'
            $newBook = Book::find($request->book_id);
            if ($newBook) {
                $newBook->update(['status' => 'unavailable']);
            }
        }

        // Perbarui data peminjaman
        $borrow->update($request->all());

        // Redirect kembali ke halaman daftar peminjaman dengan pesan sukses
        return redirect()->route('pinjam.index')->with('success', 'Borrow record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrow = Borrow::findOrFail($id);

        $book = $borrow->book;
        $book->status = 'available';
        $book->save();

        $borrow->delete();

        return redirect()->route('pinjam.index')->with('success', 'Borrow record deleted successfully');
    }
}
