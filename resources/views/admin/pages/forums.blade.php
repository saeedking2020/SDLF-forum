@extends('layouts.dashboard')

@section('content')
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">

              <!--overview start-->
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-laptop"></i> Forum Categories</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="{{route('dashboard.home')}}">Home</a></li>
                <li><i class="fa fa-users"></i>Forums</li>
              </ol>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-12">
                @if(session('message'))
                    <p class="alert {{ session('alert-class', 'alert-info') }}">{{ session('message') }}</p>
                @endif
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2><i class="fa fa-flag-o red"></i><strong>Forum Categories</strong></h2>
                  <div class="panel-actions">
                    <a href="{{route('forums')}}" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
{{--                    <a href="{{route('dashboard.home')}}" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>--}}
{{--                    <a href="{{route('dashboard.home')}}" class="btn-close"><i class="fa fa-times"></i></a>--}}
                  </div>
                </div>
                <div class="panel-body">
                  <table class="table bootstrap-datatable countries">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>

                      </tr>
                    </thead>
                    <tbody>
                        @if (count($forums)> 0)
                            @foreach ($forums as $forum)
                            <tr>
                                <td>{{$forum->title}}</td>
                                <td>{{$forum->category->title}}</td>
                                <td>{!! $forum->desc !!}</td>
                                <td><a href="{{route('forum',$forum->id)}}"><i class="fa fa-eye text-success"></i></a></td>
                                <td><a href="{{route('forum.edit',$forum->id)}}"><i class="fa fa-edit text-info"></i></a></td>
                                <td>
                                    <form action="{{ route('forum.destroy', $forum->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger" style="background:none; border:none; padding:0; cursor:pointer;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>

                              </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>

                  {{ $forums->links() }}
                </div>

              </div>

            </div>

            </div>
            <!--/col-->
        </section>
      </section>
      <!--main content end-->
@endsection
