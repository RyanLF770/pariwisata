<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingConfirmation;

class TransactionController extends Controller
{
    public function create($id)
    {
        $booking = Booking::findOrFail($id);
        return view('pages.transaction-create', compact('booking'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'payment_details' => 'required|string',
        ]);

        $booking = Booking::findOrFail($id);

        // Transaction::create([
        //     'booking_id' => $booking->id,
        //     'payment_method' => $request->payment_method,
        //     'payment_details' => $request->payment_details,
        //     'amount' => $booking->quantity * $booking->destination->price,
        // ]);

        $transaction = Transaction::create([
            'booking_id' => $booking->id,
            'payment_method' => $request->payment_method,
            'payment_details' => $request->payment_details,
            'amount' => $booking->quantity * $booking->destination->price,
        ]);

        // Send notification to admin
        // Notification::route('mail', 'admin@example.com')->notify(new BookingConfirmation($transaction));

        // Tambahkan flash message untuk pemberitahuan sukses
        return redirect()->route('transaction.success')->with('success', 'Transaction successful.');
    }

    public function success()
{
    return view('pages.transaction-success');
}
}
