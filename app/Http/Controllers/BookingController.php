<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create($id)
    {
        $destination = Destination::findOrFail($id);
        return view('pages.booking-create', compact('destination'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
        ]);

        $destination = Destination::findOrFail($id);

        Booking::create([
            'destination_id' => $destination->id,
            'user_id' => auth()->user()->id, // Mengasumsikan Anda menggunakan autentikasi Laravel
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('transaction.create', $destination->id)->with('success', 'Booking successful.');
    }

//     public function store(Request $request)
// {
//     // Validasi data
//     $request->validate([
//         'destination_id' => 'required|exists:destinations,id',
//         'quantity' => 'required|integer|min:1',
//         'payment_method' => 'required|string',
//         'payment_details' => 'required|string',
//     ]);

//     // Simpan data booking
//     $booking = Booking::create([
//         'user_id' => auth()->id(), // Pastikan user_id diisi dengan ID pengguna yang sedang login
//         'destination_id' => $request->destination_id,
//         'quantity' => $request->quantity,
//     ]);

//     // Simpan data transaksi
//     $transaction = Transaction::create([
//         'booking_id' => $booking->id,
//         'amount' => $request->quantity * $booking->destination->price,
//         'payment_method' => $request->payment_method,
//         'payment_details' => $request->payment_details,
//     ]);

//     // Update booking dengan ID transaksi
//     $booking->transaction_id = $transaction->id;
//     $booking->save();

//     return redirect()->route('transaction.success', $booking->id)->with('success', 'Transaction successful');
// }

}
