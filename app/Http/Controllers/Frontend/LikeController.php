<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Models\ActivityLog;
use App\Models\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function storelike(Request $request)
    {
        $like = new Like();
        $like->user_id = $request->input('user_id');
        $like->prod_id = $request->input('prod_id');

        $like->save();

        // Activity log ---
        $user_id = Auth::user()->id;
        $activities = new ActivityLog();
        $activities->user_id = $user_id;
        $activities->prod_id = $request->input('prod_id');
        $activities->type = 'product like';
        $activities->save();
        // Activity log ---

    }

    public function storeunlike(Request $request)
    {
        $prod_id =  $request->input('prod_id');
        $user_id =  $request->input('user_id');

        $like = Like::where('prod_id', $prod_id)
            ->where('user_id', $user_id);
        $like->delete();
    }
}
