<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Models\ActivityLog;
use App\Models\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $reviews = new Review();
        $reviews->user_id = $request->input('user_id');
        $reviews->prod_id = $request->input('prod_id');
        $reviews->review = $request->input('review');

        $reviews->save();

        // Activity log ---
        $user_id = Auth::user()->id;
        $activities = new ActivityLog();
        $activities->user_id = $user_id;
        $activities->prod_id = $request->input('prod_id');
        $activities->type = 'review';
        $activities->save();
        // Activity log ---

    }
}
