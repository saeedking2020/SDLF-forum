@extends('layouts.app')
@section('content')
    <!--main content start-->

    @if ($user)
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
                        <nav class="breadcrumb">
                            <a href="/" class="breadcrumb-item">Home</a>
                            <a href="{{route('client.users')}}"
                               class="breadcrumb-item">Users</a>
                            <span class="breadcrumb-item active">{{$user->name}}</span>
                        </nav>
                    </div>
                </div>

                <!-- Main content -->
                <section class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">

                                <!-- Profile Image -->
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            @if($user->image)
                                                <img class="profile-user-img img-fluid img-circle"
                                                     src="{{asset('storage/images/profiles/'.$user->image)}}"
                                                     alt="User profile picture">
                                            @else
                                                <img class="profile-user-img img-fluid img-circle"
                                                     src="{{asset('images/profile-picture.png')}}"
                                                     alt="User profile picture">
                                            @endif
                                        </div>

                                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                                        {{--                                     only display the user email if it is his own user or is an admin--}}
                                        @if(auth()->id() == $user->id || auth()->user()->is_admin)
                                            <p class="text-muted text-center">{{$user->email}}</p>
                                        @endif

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Topics Count:</b> <a
                                                    class="float-right">{{$user->topics->count()}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                                <!-- About Me Box -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                        <p class="text-muted">
                                            {{$user->education}}
                                        </p>

                                        <hr>

                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                        <p class="text-muted">{{$user->country}}</p>

                                        <hr>

                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                        <p class="text-muted">
                                            {{$user->skills}}
                                        </p>

                                        <hr>

                                        <strong><i class="far fa-file-alt mr-1"></i> Bio</strong>

                                        <p class="text-muted">{{$user->bio}}</p>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->


                            <div class="col-md-9">


                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                                                    data-bs-toggle="tab">Activity</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" href="#timeline"
                                                                    data-bs-toggle="tab">Timeline</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#settings"
                                                                    data-bs-toggle="tab">Settings</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="active tab-pane tab-content" id="activity">


                                                <!-- Post -->
                                                <div class="post">
                                                    @if($latest_user_post)
                                                        <div class="user-block">
                                                            @if($user->image)
                                                                <img class="profile-user-img img-fluid img-circle"
                                                                     width="50" height="50"
                                                                     src="{{asset('storage/images/profiles/'.$user->image)}}"
                                                                     alt="User profile picture">
                                                            @else
                                                                <img class="profile-user-img img-fluid img-circle"
                                                                     width="50" height="50"
                                                                     src="{{asset('images/profile-picture.png')}}"
                                                                     alt="User profile picture">
                                                            @endif
                                                            <span class="username">
                                                       <a href="#">{{$user->name}}</a>
                                                       <a href="#" class="float-right btn-tool"><i
                                                               class="fas fa-times"></i></a>
                                                   </span>
                                                            <span
                                                                class="description">started a discussion - {{$latest_user_post->created_at}}</span>
                                                        </div>
                                                        <!-- /.user-block -->

                                                        <p>
                                                            {{$latest_user_post->desc}}
                                                        </p>
                                                    @else
                                                        <p>
                                                            <b>{{$user->name}}</b> has not started any topics yet.
                                                        </p>
                                                    @endif
                                                    @if($latest_user_post)
                                                        <p>
                                                            <a href="#" class="link-black text-sm mr-2"><i
                                                                    class="fas fa-eye mr-1"></i> {{$latest_user_post->views}} @if($latest_user_post->views<=1)
                                                                    view
                                                                @else
                                                                    views
                                                                @endif</a>
                                                            <a href="#" class="link-black text-sm"><i
                                                                    class="far fa-envelope mr-1"></i>
                                                                {{$latest_user_post->replies->count()}} @if($latest_user_post->replies->count()<=1)
                                                                    reply
                                                                @else
                                                                    replies
                                                                @endif</a>
                                                            <span class="float-right">
                                                                @if(auth()->user() && auth()->user()->is_admin)
                                                                    <form
                                                                        action="{{ route('topic.delete', $latest_user_post->id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                                style="background:none; border:none; padding:0; cursor:pointer;">
                                                                            <i class="fa fa-trash text-danger"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </span>
                                                            <br><br>
                                                        </p>
                                                    @endif
                                                </div>

                                            </div>


                                            <!-- /.tab-pane -->
                                            <div class="tab-pane tab-content" id="timeline">


                                            </div>
                                            <!-- /.tab-pane -->
                                            @if($user->id == auth()->id() || auth()->user()->is_admin)
                                                <div class="tab-pane tab-content" id="settings">


                                                    <form action="{{route('user.update',$user->id)}}" method="post"
                                                          class="form-horizontal">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="inputName"
                                                                   class="col-sm-2 col-form-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="name" class="form-control"
                                                                       value="{{$user->name}}" id="inputName"
                                                                       placeholder="Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail"
                                                                   class="col-sm-2 col-form-label">Email</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" name="email" class="form-control"
                                                                       value="{{$user->email}}" id="inputEmail"
                                                                       placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone"
                                                                   class="col-sm-2 col-form-label">Phone</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="phone" value="{{$user->phone}}"
                                                                       class="form-control" id="inputName2"
                                                                       placeholder="phone">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputExperience"
                                                                   class="col-sm-2 col-form-label">Education</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control" name="education"
                                                                          id="inputExperience"
                                                                          placeholder="Describe your education background">{{$user->education}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills"
                                                                   class="col-sm-2 col-form-label">Skills</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" name="skills"
                                                                       id="inputSkills"
                                                                       placeholder="Your skills separated by comma"
                                                                       value="{{$user->skills}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputSkills"
                                                                   class="col-sm-2 col-form-label">Profession</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                       name="profession"
                                                                       id="inputSkills" placeholder="Your profession"
                                                                       value="{{$user->profession}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputExperience"
                                                                   class="col-sm-2 col-form-label">Country</label>
                                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="country" id="inputExperience"
                                                          placeholder="Country">{{$user->country}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="bio" class="col-sm-2 col-form-label">Your
                                                                Bio</label>
                                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="bio" id="inputExperience"
                                                          placeholder="A short introduction about yourself e.g. a Fullstack software engineer">{{$user->bio}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox"> I agree to the <a
                                                                            href="#">terms
                                                                            and
                                                                            conditions</a>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="offset-sm-2 col-sm-10">
                                                                <button type="submit" class="btn btn-danger">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.tab-pane -->
                                            @endif
                                        </div>
                                        <!-- /.tab-content -->
                                    </div><!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->


                <!-- page end-->
            </section>
        </section>
        <!--main content end-->
    @endif

@endsection
