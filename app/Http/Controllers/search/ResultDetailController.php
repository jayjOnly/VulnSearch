<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vulnerability;

class ResultDetailController extends Controller
{
    public function show($id)
{
    // Mengambil kerentanan berdasarkan ID
    $vulnerability = Vulnerability::findOrFail($id);

    // Cek apakah pengguna yang sedang login memiliki bookmark untuk kerentanan ini
    $isBookmarked = false;
    
    if (auth()->check()) {
        $isBookmarked = auth()->user()->hasBookmarkedVulnerability($vulnerability->id);
    }

    // Mengirim data ke view
    return view('search.detail', compact('vulnerability', 'isBookmarked'));
}
}