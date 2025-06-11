@extends('layouts.dashboard')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i>Forum</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="{{route('dashboard.home')}}">Home</a></li>
                        <li><i class="fa fa-users"></i>Forums</li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Forum</strong></h2>
                            <div class="panel-actions">
                                <a href="{{route('forum',$forum->id)}}" class="btn-setting"><i
                                        class="fa fa-rotate-right"></i></a>
                                {{--                                <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>--}}
                                {{--                                <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>--}}
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-4">
                                        <div class="card" style="width: 18rem;">
                                            <p class="card-text">{{ $forum->category->title }}</p>
                                            <div class="card-body">
                                                <h5 class="card-title">{{$forum->title}}</h5>
                                                <p class="card-text">{!! $forum->desc !!}</p>
                                                <form action="{{ route('forum.destroy', $forum->id) }}" method="POST"
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!--/col-->
        </section>
    </section>
    <!--main content end-->
@endsection
