<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::latest()->paginate(10);

        return view('admin.pages.forums',compact('forums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.pages.new_forum',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required'
        ]);
//        dd($request->all());
        Forum::create($request->all());

        return back()->with('message', 'Forum created Successfully')
            ->with('alert-class', 'alert-success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $forum = Forum::find($id);

        return view('admin.pages.single_forum',compact('forum'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $forum = Forum::find($id);
        $categories = Category::latest()->get();

        return view('admin.pages.edit_forum',compact('forum','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:5',
            'desc' => 'required|min:5'
        ]);

        $forum = Forum::where('id',$id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id
        ]);

        return redirect()->route('dashboard.home')->with('message', 'Forum updated Successfully')
            ->with('alert-class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Forum::find($id)->delete();

        return redirect()->route('dashboard.home')->with('message', 'Forum Deleted Successfully')
            ->with('alert-class', 'alert-success');

    }
}
