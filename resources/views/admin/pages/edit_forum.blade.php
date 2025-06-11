@extends('layouts.dashboard')

@section('content')
    <!--main content start-->


    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i>Edit Forum</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href={{route('dashboard.home')}}>Home</a></li>
                        <li><i class="fa fa-question"></i>Forum</li>
                        <li><i class="fa fa-plus"></i>Edit</li>
                    </ol>
                </div>
            </div>


            <!-- edit-profile -->
            <div id="edit-profile" class="tab-pane">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
                        {{--                        @if ($errors->any())--}}
                        {{--                            @foreach ($errors->all() as $error)--}}
                        {{--                                {{$error}}--}}
                        {{--                            @endforeach--}}
                        {{--                        @endif--}}
                        @if(session('message'))

                            <p class="alert
      {{ session('alert-class', 'alert-info') }}">{{ session('message') }}</p>

                        @endif
                        @if($forum)
                            <form class="form-horizontal" method="POST"
                                  action="{{ route('forum.update',$forum->id)}}">
                                @csrf

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category Title</label>
                                    <div class="col-lg-10">
                                        <input name="title" class="form-control" value="{{$forum->title}}"/>
                                    </div>
                                </div>
                                @error('title')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Forum Category</label>
                                    <div class="col-lg-10">
                                        <select name="category_id" class="form-control">
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Category description</label>
                                    <div class="col-lg-10">
                                    <textarea name="desc" id="editor1" class="form-control" cols="30"
                                              rows="5">{!! $forum->desc !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    @error('desc')
                                    <p class="alert alert-danger">{{$message}}</p>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <a href="/dashboard/categories" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </section>
            </div>


        </section>
    </section>
    <!--main content end-->

@endsection
