<?php

namespace App\Http\Controllers\Verdict;

use App\Http\Controllers\Controller;
use App\Models\Verdict;
use Illuminate\Http\Request;

class VerdictController extends Controller
{
    public function index()
    {
        return Verdict::all(['id', 'description']);
    }
    public function show()
    {
        return Verdict::select(['id', 'description'])->findOrFail(request()->id);
    }
}
