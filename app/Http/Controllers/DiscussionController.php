<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $forums = Forum::latest()->get();
        $forum = Forum::find($id);

        return view('client.new-topic',compact('forums','forum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notify = 0;
        if ($request->notify && $request->notify=="on"){
            $notify = 1;
        }

        Topic::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'forum_id' => $request->forum_id,
            'user_id' => auth()->id(),
            'notify' => $notify
        ]);

        return redirect()->back()->with('message','Topic created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
