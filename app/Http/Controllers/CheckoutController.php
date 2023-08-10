<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Book;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->copies <= 0) {
            return response()->json(['message' => 'Book is out of stock'], 400);
        }

        $checkout = Checkout::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'checkout_date' => now(),
        ]);

        $book->decrement('copies');

        return response()->json($checkout, 201);
    }
    public function update(Request $request, $id)
    {
        $checkout = Checkout::findOrFail($id);

        if ($checkout->return_date !== null) {
            return response()->json(['message' => 'This book has already been returned'], 400);
        }

        $checkout->update([
            'return_date' => now(),
        ]);

        $book = Book::findOrFail($checkout->book_id);
        $book->increment('copies');

        return response()->json($checkout, 200);
    }
}
