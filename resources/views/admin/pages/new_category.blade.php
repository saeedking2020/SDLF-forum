<?php

use Illuminate\Support\Facades\Session;

?>
@extends('layouts.dashboard')

@section('content')
    <!--main content start-->


    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i>Add new Category</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="{{route('dashboard.home')}}">Home</a></li>
                        <li><i class="fa fa-question"></i>Category</li>
                        <li><i class="fa fa-plus"></i>Add</li>
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
                            <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('message') }}</p>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('category.store')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Category Title</label>
                                <div class="col-lg-10">
                                    <input name="title" class="form-control" value=""/>
                                </div>
                            </div>
                            @error('title')
                            <p class="alert alert-danger">{{$message}}</p>
                            @enderror

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Category Image</label>
                                <div class="col-lg-10">
                                    <input type="file" name="image" class="form-control"/>
                                </div>
                            </div>
                            @error('image')
                            <p class="alert alert-danger">{{$message}}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Category description</label>
                                <div class="col-lg-10">
                                    <textarea name="desc" id="editor1" class="form-control" cols="30"
                                              rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                @error('desc')
                                <p class="alert alert-danger">{{$message}}</p>
                                @enderror
                            </div>


                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>


        </section>
    </section>
    <!--main content end-->

@endsection
