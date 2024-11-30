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
            'page' => 'integer|min:1',
        ]);

        $query = $request->input('query');
        $perPage = 8; // Number of results per page


        // Mencari vulnerabilities berdasarkan deskripsi
        $results = Vulnerability::where('description', 'like', '%' . $query . '%')
            ->orderBy('cvss_score', 'desc') // Ganti 'desc' dengan 'asc' jika ingin ascending
            ->paginate($perPage);


        return view('search.result', compact('results', 'query')); // Pastikan untuk membuat view ini
    }
}
