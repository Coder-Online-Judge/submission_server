<?php

namespace App\Http\Controllers\Language;

use App\Http\Controllers\Controller;
use App\Models\Language;

class LanguageController extends Controller
{
    public function show($id)
    {
        return Language::select(['id', 'name', 'is_archived'])->findOrFail($id);
    }
    public function showActiveLanguage()
    {
        return Language::where(['is_archived' => '0'])->get(['id', 'name']);
    }
    public function showAllLanguage()
    {
        return Language::all(['id', 'name', 'is_archived']);
    }
}
