<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $categories = Category::latest()->paginate(15);
        $topics = Topic::latest()->paginate(15);
        $forums = Forum::latest()->paginate(15);
        $users = User::latest()->paginate(15);


        return view('admin.pages.home', compact('categories', 'topics', 'forums', 'users'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.pages.users', compact('users'));

    }

    public function show($id)
    {
        $latest_user_post = Topic::where('user_id', $id)->latest()->first();
        $latest = Topic::latest()->first();
        $user = User::find($id);

        return view('admin.pages.user', compact('user', 'latest_user_post', 'latest'));

    }

    public function profile()
    {
        $latest_user_post = Topic::where('user_id', auth()->id())->latest()->first();
        $latest = Topic::latest()->first();
        $user = auth()->user();

        return view('admin.pages.user', compact('user', 'latest_user_post', 'latest'));

    }

    public function destroy($id)
    {
        User::find($id)->delete();
        toastr()->success('User deleted successfully!');

        return redirect()->back();
    }

    public function notifications()
    {
        //return the notifications that are not read.(read_at = null)
        $notifications = auth()->user()->notifications()->where('read_at', null)->latest()->paginate(15);
        return view('admin.pages.notifications',compact('notifications'));

    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id',$id)->first();
        $notification->markAsRead();
        toastr()->info('Notification marked as read!');

        return redirect()->back();
    }

    public function notificationDestroy($id)
    {
        $notification = auth()->user()->notifications()->where('id',$id);
        $notification->delete();
        toastr()->success('Notification deleted successfully!');

        return redirect()->back();

    }

    public function settingsForm()
    {
        $setting = Setting::latest()->first();
        if ($setting)
            $setting = $setting['forum_name'];
        else
            $setting = '';
        return view('admin.pages.settings',compact('setting'));

    }
    public function newSetting(Request $request)
    {
        $request->validate([
            'forum_name' => 'required|min:5'
        ]);
        Setting::create([
            'forum_name' => $request->forum_name
        ]);
        toastr()->success('Settings saved successfully');

        return redirect()->back();
    }
}
