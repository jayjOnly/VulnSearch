<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vulnerability;

class SearchController extends Controller
{
    public function show() {
        return view('search.search');
    }

    // Mengambil hasil pencarian
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $query = $request->input('query');

        // Mencari vulnerabilities berdasarkan deskripsi
        $results = Vulnerability::where('description', 'like', '%' . $query . '%')
            ->orderBy('cvss_score', 'desc') // Ganti 'desc' dengan 'asc' jika ingin ascending
            ->get();

        return view('search.result', compact('results', 'query')); // Pastikan untuk membuat view ini
    }
}
