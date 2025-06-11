@extends('layouts.dashboard')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-dashboard"></i> Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="{{route('home')}}">Home</a></li>
                        <li><i class="fa fa-dashboard"></i>Dashboard</li>
                    </ol>
                </div>
            </div>

            <div class="flash-message">
                @if(session('message'))
                    <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('message') }}</p>
                @endif
            </div> <!-- end .flash-message -->

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box blue-bg">
                        <i class="fa fa-list-alt"></i>
                        @if($categories->count() > 0)
                            <div class="count">{{$categories->count()}}</div>
                        @else
                            <div class="count">0</div>
                        @endif
                        <div class="title">Categories</div>
                    </div>
                    <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box brown-bg">
                        <i class="fa fa-users"></i>
                        @if($users->count() > 0)
                            <div class="count">{{$users->count()}}</div>
                        @else
                            <div class="count">0</div>
                        @endif

                        <div class="title">Users</div>
                    </div>
                    <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box dark-bg">
                        <i class="fa fa-users"></i>
                        @if($forums->count() > 0)
                            <div class="count">{{$forums->count()}}</div>
                        @else
                            <div class="count">0</div>
                        @endif
                        <div class="title">Forums</div>
                    </div>
                    <!--/.info-box-->
                </div>
                <!--/.col-->

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box green-bg">
                        <i class="fa fa-comment"></i>
                        @if($topics->count() > 0)
                            <div class="count">{{$topics->count()}}</div>
                        @else
                            <div class="count">0</div>
                        @endif
                        <div class="title">Topics</div>
                    </div>
                    <!--/.info-box-->
                </div>
                <!--/.col-->

            </div>
            <!--/.row-->
            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Registered Users</strong></h2>
                            <div class="panel-actions">
                                <a href="{{route('dashboard.home')}}" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
{{--                                <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>--}}
{{--                                <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>--}}
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Rank</th>
                                    <th>View</th>

                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                @if (count($users)> 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->rank}}</td>
                                            <td><a href="{{route('show_user',$user->id)}}"><i
                                                        class="fa fa-eye text-success"></i></a></td>

                                            <td>
                                                <form action="{{ route('user.delete', ['id' => $user->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm text-danger" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                            {{ $users->links() }}
                        </div>

                    </div>

                </div>

            </div>
            <!--/col-->


        </section>


    </section>
    <!--main content end-->
@endsection
