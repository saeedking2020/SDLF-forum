@extends('layouts.app')

@section('content')
        <nav class="breadcrumb">
            <a href="/" class="breadcrumb-item">Forum Categories</a>
            <a href="{{route('category.overview',$forum->category->id)}}"
               class="breadcrumb-item">{{$forum->category->title}}</a>
            <a href="{{route('forum.overview',$forum->id)}}" class="breadcrumb-item">{{$forum->title}}</a>
            <span class="breadcrumb-item active">new Topic</span>
        </nav>

        <div class="row">
            @if(session('message'))
                <div class="col-lg-12">
                    <p class="alert alert-success">{{session('message')}}</p>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="row">
                    <!-- Category one -->
                    <div class="col-lg-12">
                        <!-- second section  -->
                        <h4 class="text-white bg-info mb-0 p-4 rounded">Create new Topic</h4>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('topic.store')}}" class="mb-3" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Topic Title</label>
                <input type="text" class="form-control" name="title"/>
            </div>
            <div class="form-group">
                <label for="title">Forum name</label>
                <select name="forum_id" class="form-control">
                    @foreach($forums as $forum)
                        <option value="{{$forum->id}}">{{$forum->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Description</label>
                <textarea
                    class="form-control"
                    name="desc"
                    id=""
                    rows="10"
                    required
                ></textarea>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" name="notify" class="form-check-input"/>
                    Notify me upon reply
                </label>
            </div>

            <button type="submit" class="btn btn-primary mt-2 mb-lg-5">
                Create Topic
            </button>
            <button type="reset" class="btn btn-danger mt-2 mb-lg-5">Reset</button>
        </form>
        <div></div>
        <p class="small">
            <a href="#">Have you forgotten your account details?</a>
        </p>
@endsection
