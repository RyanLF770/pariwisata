<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function destinationAdd(){
        return view('pages.destination-add');
    }

    public function show(){
        $destinations = Destination::all();

        return view('pages.destination-management', compact('destinations'));
    }

    public function showToindex(Request $request)
    {
        $destinations = Destination::all();

        return view('user.index', compact('destinations'));
    }

    public function destinationStore(Request $request)
    {
        // Validasi data
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Simpan file gambar ke direktori 'public/images'
        $imagePath = $request->file('image')->store('images', 'public');

        // Simpan data ke database
        Destination::create([
            'image' => $imagePath, // Simpan path gambar
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // Redirect ke halaman manajemen pengguna dengan pesan sukses
        return redirect()->route('destination.management')->with('success', 'Destination added successfully.');
    }

    public function edit($id)
{
    $destination = Destination::findOrFail($id);
    return view('pages.destination-edit', compact('destination'));
}

public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
    ]);

    // Temukan destination berdasarkan ID
    $destination = Destination::findOrFail($id);

    // Jika ada gambar baru yang di-upload
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($destination->image) {
            Storage::delete('public/' . $destination->image);
        }
        // Simpan file gambar baru ke direktori 'public/images'
        $imagePath = $request->file('image')->store('images', 'public');
        $destination->image = $imagePath;
    }

    // Update data destination
    $destination->title = $request->title;
    $destination->price = $request->price;
    $destination->description = $request->description;
    $destination->save();

    // Redirect ke halaman manajemen destinasi dengan pesan sukses
    return redirect()->route('destination.management')->with('success', 'Destination updated successfully.');
}

public function destinationDelete($id)
{
    $destination = Destination::findOrFail($id);

    // Hapus gambar jika ada
    if ($destination->image) {
        Storage::delete('public/' . $destination->image);
    }

    // Hapus data dari database
    $destination->delete();

    // Redirect ke halaman manajemen destinasi dengan pesan sukses
    return redirect()->route('destination.management')->with('success', 'Destination deleted successfully.');
}

public function showDetail($id)
{
    $destination = Destination::findOrFail($id);

    $destination = Destination::with('ratings')->findOrFail($id);
    
    return view('pages.destination-detail', compact('destination'));
}

public function addRating(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string',
    ]);

    $destination = Destination::findOrFail($id);

    // Simpan rating ke dalam database
    $destination->ratings()->create([
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->route('destination.detail', $destination->id)->with('success', 'Rating added successfully.');
}


}
