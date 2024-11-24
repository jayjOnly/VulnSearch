<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vulnerability;

class ResultDetailController extends Controller
{
    public function show($id) {
        // Mengambil kerentanan berdasarkan ID
        $vulnerability = Vulnerability::findOrFail($id);
        return view('search.detail', compact('vulnerability'));
    }
}