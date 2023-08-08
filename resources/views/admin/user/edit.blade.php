@extends('admin.layout.default')
@section("title_area", 'Profile Change')
@section("main_section")

<div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <form action="{{ route('user.store', ['user_id' => $userByID->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-group panel-group-joined" id="accordion-test">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                            Change Profile
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Name</label><small class="req">*</small>
                                                <input name="name" type="text" value="{{ $userByID->name }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="phone">Mobile</label><small class="req">*</small>
                                                <input name="mobile" type="text" value="{{ $userByID->mobile }}" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Email</label><small class="req">*</small>
                                                <input name="email" type="email" value="{{ $userByID->email }}" class="form-control" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="email">Address</label><small class="req">*</small>
                                                <textarea name="address" type="text" class="form-control">{{ $userByID->address }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="picture">Photo</label>(<code>JPG PNG MAX 1MB</code>)
                                                <input  data-max-file-size="1100K" data-default-file="{{ asset($userByID->photo) }}" data-allowed-file-extensions="jpg png jpeg" name="photo" type="file" class="form-control" id="picture">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group pull-left m-t-22">
                                                <input type="submit" class=" btn btn-primary pull-right" value="Change" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>
                            </div> <!-- panel -->
                        </div>
                    </form>
                </div> <!-- col -->
                <div class="col-md-5">
                    <form action="{{ route('user.change_password') }}" method="POST">
                    @csrf
                        <div class="panel-group panel-group-joined" id="accordion-test2">
                            <div class="panel panel-border panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion-test2" href="#collapse2" class="collapsed">
                                            Change Password
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">Change Password</label><small class="req">*</small>
                                                <input name="password" type="password" value="" class="form-control" required>
                                                <input name="id" type="hidden" value="@isset($userByID){{  $userByID->id }} @endisset">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group pull-left m-t-22">
                                                <input type="submit" class=" btn btn-primary pull-right" value="Change" name="submit" />
                                            </div>
                                        </div>
                                    </div> <!-- panel-body -->
                                </div>

                            </div> <!-- panel -->
                        </div>
                    </form>
                </div> <!-- col -->
            </div> <!-- End row -->
        </div> <!-- container -->
    </div>
    <script>
        
    </script>
@endsection