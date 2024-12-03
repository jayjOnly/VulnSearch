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

        $searchTerms = explode(' ', $query); // Memecah "IBM 10.0" menjadi ["IBM", "10.0"]

        $results = Vulnerability::where(function($q) use ($searchTerms) {
            foreach($searchTerms as $term) {
                $q->where('description', 'like', '%' . $term . '%');
            }
        })
        ->orderBy('cvss_score', 'desc')
        ->paginate($perPage);


        return view('search.result', compact('results', 'query')); // Pastikan untuk membuat view ini
    }
}
