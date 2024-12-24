<?php

namespace App\Http\Controllers\search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchResultController extends Controller
{
    public function show() {
        return view('search.result');
    }
}
