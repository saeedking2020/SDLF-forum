<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    //checks if the user is active and logged in
    //if the session of the user is expired, it won't show
    //a combination of the users stored in the session of the database and users table for their information
    public function getActiveLoggedInUsers()
    {
        $lifetimeMinutes = Config::get('session.lifetime');
        $activeThreshold = Carbon::now()->subMinutes($lifetimeMinutes)->timestamp;

        return DB::table(Config::get('session.table'))
            ->distinct()
            ->select(['users.id', 'users.name', 'users.email'])
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', $activeThreshold)
            ->leftJoin('users', Config::get('session.table') . '.user_id', '=', 'users.id')
            ->get();
    }

    public function index()
    {
        $onlineUsers = $this->getActiveLoggedInUsers();
        $forumsCount = count(Forum::all());
        $topicsCount = count(Topic::all());
        $totalMembers = count(User::all());
        $newest = User::latest()->first();
        $totalCategories = count(Category::all());
        $categories = Category::latest()->get();
        $latest_few_users = User::latest()->take(5)->get();

        return view('welcome', compact('categories','forumsCount','topicsCount','newest','totalMembers','totalCategories','onlineUsers','latest_few_users'));
    }

    public function categoryOverview($id)
    {
        $category = Category::find($id);

        $onlineUsers = $this->getActiveLoggedInUsers();
        $forumsCount = count(Forum::all());
        $topicsCount = count(Topic::all());
        $totalMembers = count(User::all());
        $newest = User::latest()->first();
        $totalCategories = count(Category::all());

        return view('client.category-overview',compact('category','forumsCount','topicsCount','newest','totalMembers','totalCategories','onlineUsers'));
    }

    public function forumOverview($id)
    {
        $forum = Forum::find($id);

        return view('client.forum-overview',compact('forum'));
    }

    public function profile($id)
    {
        $latest_user_post = Topic::where('user_id', $id)->latest()->first();
        $latest = Topic::latest()->first();
        $user = User::find($id);

        return view('client.user_profile',compact('user','latest','latest_user_post'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);

        return view('client.users',compact('users'));
    }

    public function photoUpdate(Request $request, $id)
    {
        $request->validate([
            'image' => 'image|max:2048'
        ]);

        if (!$request->image){
            toastr()->error('Please select an image!');
            return redirect()->back();
        }
        $user = User::find($id);
        $image = $request->image;
//        $name = $image->getClientOriginalName();
//        $extension = $image->getClientOriginalExtension();
        if ($user->image) {
            $dir = 'images/profiles/' . $user->image;
            if (Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->delete($dir);
            }
        }
        $new_image_name = time(). '.' . $request->image->extension();
        $user->update([
           'image' => $new_image_name
        ]);
        $request->image->storeAs('images/profiles/',$new_image_name,'public');

        toastr()->success('The profile photo uploaded successfully');
        return back();
    }
}
