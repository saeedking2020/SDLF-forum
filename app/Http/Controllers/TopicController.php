<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Topic;
use App\Models\TopicReply;
use App\Models\User;
use App\Models\UserReaction;
use App\Notifications\NewReply;
use App\Notifications\NewTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Telegram\Bot\Laravel\Facades\Telegram;

class TopicController extends Controller
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

        return view('client.new-topic', compact('forums', 'forum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notify = 0;
        if ($request->notify && $request->notify == "on") {
            $notify = 1;
        }

        Topic::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'forum_id' => $request->forum_id,
            'user_id' => auth()->id(),
            'notify' => $notify
        ]);

        //for new topic creation, increase user rank by 10
        $user = auth()->user();
        $user->increment('rank',10);


        $admins = User::where('is_admin', 1)->get();
        $latestTopic = Topic::latest()->first();
        foreach ($admins as $admin) {
            $admin->notify(new NewTopic($latestTopic));
        }

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID', '-4951615759'),
            'parse_mode' => 'HTML',
            'text' => '<b>' . auth()->user()->name . '</b> Started a new Topic: <b>' . $request->title . '</b>'
        ]);

        toastr()->info('A message was sent to Telegram!');


        return redirect()->back()->with('message', 'Topic created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::find($id);
        if ($topic)
            $topic->increment('views', 1);
        return view('client.topic', compact('topic'));
    }

    /**
     * Save reply to the database
     */
    public function reply(Request $request, $id)
    {
        TopicReply::create([
            'desc' => $request->desc,
            'user_id' => auth()->id(),
            'topic_id' => $id
        ]);

        //for reply, increase user rank by 10
        $user = auth()->user();
        $user->increment('rank',10);

        $admins = User::where('is_admin', 1)->get();
        $latestReply = TopicReply::latest()->first();
        foreach ($admins as $admin) {
            $admin->notify(new NewReply($latestReply));
        }


        $topic = Topic::find($id);
        $forumId = $topic->forum->id;
        $url = URL::to('/forum/overview/' . $forumId);

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_ID', '-4951615759'),
            'parse_mode' => 'HTML',
            'text' => '<b>' . auth()->user()->name . '</b> replied to the topic <b>' . $topic->title . ':</b>' . "\n" .
                $request->desc . "\n" .
                "<a href=\"{$url}\">Read it here</a>"
        ]);

        toastr()->success('Reply sent successfully!');
        toastr()->info('A message was sent to Telegram!');

        return redirect()->back();
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
//    remove the topic
    public function destroy(string $id)
    {
        $reply = TopicReply::find($id);
        $reply->delete();

        toastr()->success('Reply deleted successfully!');

        return redirect()->back();
    }

    //so that the messages are taken from the telegram bot
    public function updates()
    {
        $updates = Telegram::getUpdates();
        dd($updates);
    }

//    remove the topic with no replies / if there are any replies to a topic, can't be removed
    public function remove($id)
    {
        Topic::find($id)->delete();
        toastr()->success('Topic deleted successfully!');

        return redirect()->back();

    }

    public function like($id)
    {
        $reply = TopicReply::find($id);
        $user_id = $reply->user_id;
        $owner = User::where('id',$user_id);//the owner of the reply
        //check if the user has already like this post
        //This is to assure, the user can only like each reply once
        if (UserReaction::where('user_id', auth()->id())
            ->where('reply_id', $id)->where('like_dislike',true)
            ->exists()) {
            toastr()->warning('You have already liked the post');
        }else {
            $reply->increment('likes', 1);
            UserReaction::create([
                'user_id' => auth()->id(),
                'reply_id' => $id,
                'like_dislike' => true
            ]);
            $owner->increment('rank', 10);
            toastr()->success('Like saved successfully!');
        }
        return redirect()->back();
    }
    public function dislike($id)
    {
        $reply = TopicReply::find($id);
        $owner = User::where('id',$reply->user_id);//the owner of the reply

        //check if the user has already disliked this post
        //This is to assure, the user can only dislike each reply once
        if (UserReaction::where('user_id', auth()->id())
            ->where('reply_id', $id)->where('like_dislike',false)
            ->exists()) {
            toastr()->warning('You have already disliked the post');
        }else {
            $reply->increment('dislikes', 1);
            UserReaction::create([
                'user_id' => auth()->id(),
                'reply_id' => $id,
                'like_dislike' => false
            ]);
            $owner->decrement('rank', 10);
            toastr()->success('Dislike saved successfully!');
        }
        return redirect()->back();
    }
}
