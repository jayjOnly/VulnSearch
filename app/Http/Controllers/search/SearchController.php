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

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
            'page' => 'integer|min:1',
            'severity' => 'string|nullable'
        ]);

        $query = $request->input('query');
        $severity = $request->input('severity');
        $perPage = 8;

        $searchTerms = explode(' ', $query);

        $baseQuery = Vulnerability::where(function($q) use ($searchTerms) {
            foreach($searchTerms as $term) {
                $q->where('description', 'like', '%' . $term . '%');
            }
        });

        $counts = [
            'HIGH' => (clone $baseQuery)->where('severity', 'HIGH')->count(),
            'MEDIUM' => (clone $baseQuery)->where('severity', 'MEDIUM')->count(),
            'LOW' => (clone $baseQuery)->where('severity', 'LOW')->count(),
            'N/A' => (clone $baseQuery)->where('severity', '0')->count(),
        ];

        if ($severity === 'N/A') {
            $baseQuery->where('severity', '0');
        } elseif ($severity) {
            $baseQuery->where('severity', $severity);
        }

        $results = $baseQuery->orderBy('cvss_score', 'desc')->paginate($perPage);

        return view('search.result', compact('results', 'query', 'severity', 'counts'));
    }
}
