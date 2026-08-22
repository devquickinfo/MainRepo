<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mainidcard;
use App\Models\School;

class MainidcardController extends Controller
{
    public function store(Request $request)
    {
        $schoolId = Auth::user()->school_id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'orientation' => 'required|in:portrait,landscape',
            'card_width' => 'required|integer',
            'card_height' => 'required|integer',
            'background' => 'nullable|string',
            'layout' => 'required|array',
        ]);

        $isFirst = !Mainidcard::where(
            'school_id',
            $schoolId
        )->exists();

        $mainidcard = Mainidcard::create([
            'school_id' => $schoolId,
            'name' => $validated['name'],
            'orientation' => $validated['orientation'],
            'card_width' => $validated['card_width'],
            'card_height' => $validated['card_height'],
            'background' => $validated['background'] ?? null,
            'layout' => $validated['layout'],
            'is_default' => $isFirst,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'ID Card saved successfully.',
            'id' => $mainidcard->id,
        ]);
    }
}
