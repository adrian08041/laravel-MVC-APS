<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    
    public function toggleViewMode(Request $request)
    {
        $currentMode = $request->cookie('view_mode', 'grid');
        $newMode = $currentMode === 'grid' ? 'list' : 'grid';


        return back()->cookie('view_mode', $newMode, 60 * 24 * 30);
    }
}
