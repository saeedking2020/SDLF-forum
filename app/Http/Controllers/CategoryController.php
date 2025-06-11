<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\NewCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Telegram\Bot\Laravel\Facades\Telegram;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return view('admin.pages.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.new_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:4',
            'desc' => 'required|min:4',
            'image' => 'required|image|max:2048'
        ]);
        $category = new Category;
//        Category::create($request->all());
        $category->title = $request->title;
        $category->desc = $request->desc;
        $category->user_id = auth()->id();

        $imageName = time() . '.' . $request->image->extension();
        $category->image = $imageName;
        $request->image->storeAs('images/categories', $imageName, 'public');



        $category->save();

        $admins  = User::where('is_admin',1)->get();
        $latestCategory = Category::latest()->first();
        foreach ($admins as $admin){
            $admin->notify(new NewCategory($latestCategory));
        }

        //Telegram
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID', '-4951615759'),
            'parse_mode' => 'HTML',
            'text' => '<b>' . auth()->user()->name . '</b> Created Category <b>' . $latestCategory->title . '</b>'
        ]);


        return back()->with('message', 'Category Created Successfully')
            ->with('alert-class', 'alert-success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        return view('admin.pages.single_category',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        return view('admin.pages.edit_category',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'image' => 'image|max:2048'
        ]);
        $category = Category::find($id);

        if ($request->image){
            $file_path = 'images/categories/'.$category->image;
            if(Storage::disk('public')->exists($file_path))
                Storage::disk('public')->delete($file_path);
            $new_image_name = time(). '.' . $request->image->extension();
            $category->update([
                'image' => $new_image_name
            ]);
            $request->image->storeAs('images/categories',$new_image_name,'public');

        }
        $category->update([
           'title' => $request->title,
           'desc' => $request->desc,
        ]);

        return redirect()->route('categories')->with('message', 'Category updated Successfully')
        ->with('alert-class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories')->with('message', 'Category deleted Successfully')
            ->with('alert-class', 'alert-success');
    }


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


    /** Search Category based on title
     * @param Request $request
     * @return
     */
    public function search(Request $request)
    {
        $onlineUsers = $this->getActiveLoggedInUsers();
        $forumsCount = count(Forum::all());
        $topicsCount = count(Topic::all());
        $totalMembers = count(User::all());
        $newest = User::latest()->first();
        $totalCategories = count(Category::all());
        $categories = Category::where('title', 'LIKE', '%'.$request->keyword.'%')->get();

        $latest_few_users = User::latest()->take(5)->get();

        return view('welcome', compact('categories','forumsCount','topicsCount','newest','totalMembers','totalCategories','onlineUsers','latest_few_users'));
    }
}
