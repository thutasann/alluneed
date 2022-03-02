<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class ActivityController extends Controller
{
    public function activityindex($user_name, Request $request)
    {
        if (Auth::user()) {
            if ($request->get('actdel')) {
                $id = Crypt::decrypt($request->get('actdel'));
                $activities = ActivityLog::find($id);
                $activities->status = "1"; //0=show,1=delete
                $activities->update();
                return redirect()->back()->with('actdel', 'One Activity Moved to the Trash');
            }
            else if ($request->get('actres')) {
                $id = Crypt::decrypt($request->get('actres'));
                $activities = ActivityLog::find($id);
                $activities->status = "0"; //0=show,1=delete
                $activities->update();
                return redirect()->back()->with('actres', 'One Activity Restored from the Trash');
            }
            else if ($request->get('Trash') == 'removed-activities') {
                $user_id = Auth::user()->id;
                $activities = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'prod_search') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'search')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'prod_detail') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'view detail')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'prod_like') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'product like')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'prod_review') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'review')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'profile_view') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'profile view')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'vendor_view') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'vendor view')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else if ($request->get('activitytag') == 'profile_update') {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->where('type', 'profile update')
                    ->orderByRaw('created_at DESC')
                    ->get();

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }
            else {
                $user_id = Auth::user()->id;

                $activities = ActivityLog::where('status', '!=', '1')
                    ->where('user_id', $user_id)
                    ->orderByRaw('created_at DESC')
                    ->paginate(4);

                $trashcount = ActivityLog::where('status', '1')
                    ->where('user_id', $user_id)
                    ->get();
            }

            return view('frontend.user.activitylog')->with('activities', $activities)
                ->with('trashcount', $trashcount);
        }
        else {
            return redirect()->route('login')->with('pls-login', 'Please Login First');
        }
    }
}
