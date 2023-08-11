@extends('frontend.layout.default')
@section('title_area', 'Student Account')
@section('main_section')
<style>
    #password-strength-status {
        color: #FFFFFF;
        border-radius: 4px;
    }

    .medium-password {
        background-color: #b7d60a;
        border: #BBB418 1px solid;
    }

    .weak-password {
        background-color: #ce1d14;
        border: #AA4502 1px solid;
    }

    .strong-password {
        background-color: #12CC1A;
        border: #0FA015 1px solid;
        margin-top: 5px;
        padding: 5px 10px;
    }
</style>

<section class="page-banner" style="min-height: 200px; position: relative; overflow: hidden;">
    <div class="page-banner-wrap">
        <div class="banner-bg inline-bg" style="background: url({{ asset('frontend/assets/images/footer-bg.png') }}); min-height: 200px;">
        </div>
    </div>
    <div class="all-page-heading">
        <div class="bnr-des">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="clearfix ulc">
                            <li class="delim"><a href="{{url('/')}}" title="Home">Home</a></li>
                            <li class="delim">Become A Student</li>
                        </ul>
                        <h1 class="bnr-des-title">Student Account Sign-Up</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<section class="member-panel-form-sec-wrp" style="background-color: #f4f4f4;">
    <div class="container">
      <div class="row pb-4 justify-content-center">
        <div class="col-md-8">
          <div class="member-panel-form-block">
            <div class="member-panel-form-wrp">
              
              <div class="member-panel-form">
                <div class="member-panel-form-tbs">
                    <h2>Sign up</h2>
                    <p class="auth-form-text mb-4">Already have an account? <a href="{{ url('/') }}" title="Login here"  target="_blank">Login here</a></p>
                    @if(Session::has('message'))
                        <div class="alert alert-{{Session::get('class')}}">{{Session::get("message")}}</div>
                    @endif
                    <form action="{{ url('save-student') }}" method="post" enctype="multipart/form-data">
                    @csrf
                      
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Student Name <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="full_name" value="{{old('full_name')}}" class="form-control" placeholder="Enter Full Name" />
                                  <span class="error text-danger"> {{ $errors->first('full_name') }} </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Father Name <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="father_name" value="{{old('father_name')}}" class="form-control" placeholder="Enter Father Name" />
                                  <span class="error text-danger"> {{ $errors->first('father_name') }} </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Mother Name <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="mother_name" value="{{old('mother_name')}}" class="form-control" placeholder="Enter Father Name" />
                                  <span class="error text-danger"> {{ $errors->first('mother_name') }} </span>
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Mobile Number <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter mobile number" />
                                  <span class="error text-danger"> {{ $errors->first('phone') }} </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Email</label>
                                  <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter email" />
                                  <span class="error text-danger"> {{ $errors->first('email') }} </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Age <span style="color:#DC3545">*</span></label>
                                  <input type="number" name="age" value="{{old('age')}}" class="form-control" placeholder="Enter age" />
                                  <span class="error text-danger"> {{ $errors->first('age') }} </span>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Grade <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="grade" value="{{old('grade')}}" class="form-control" placeholder="Enter grade" />
                                  <span class="error text-danger"> {{ $errors->first('grade') }} </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>School</label>
                                  <input type="text" name="school" value="{{old('school')}}" class="form-control" placeholder="Enter school" />
                                  <span class="error text-danger"> {{ $errors->first('school') }} </span>
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>District <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="district" value="{{old('district')}}" class="form-control" placeholder="Enter district" />
                                  <span class="error text-danger"> {{ $errors->first('district') }} </span>
                              </div>
                          </div>
                      </div>
                      
                      <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                  <label>Username <span style="color:#DC3545">*</span></label>
                                  <input type="text" name="user_name" value="" class="form-control" placeholder="Enter user_name" />
                                  <span class="error text-danger"> {{ $errors->first('user_name') }} </span>
                              </div>
                            </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Password <span style="color:#DC3545">*</span></label>
                                  <input type="password" name="password" id="password" value="" class="form-control" placeholder="Enter password" />
                                  <span class="error text-danger"> {{ $errors->first('password') }} </span>
                                  <div id="password-strength-status"></div> 
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Confirm Password <span style="color:#DC3545">*</span></label>
                                  <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control" placeholder="Enter confirm password" onkeyup="checkPass(); return false;" />
                                  <span class="error text-danger"> {{ $errors->first('password_confirmation') }} </span>
                                  <span id="confirmMessage" class="confirmMessage"></span>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label>Address <span style="color:#DC3545">*</span></label>
                          <textarea name="address" class="form-control" placeholder="Address...">{{old('address')}}</textarea>
                          <span class="error text-danger"> {{ $errors->first('address') }} </span>
                      </div>

                      <div class="form-group">
                          <label>Facebook Link <span style="color:#DC3545">*</span></label>
                          <input type="text" name="fb_link" value="" class="form-control" placeholder="Enter fb_link" />
                          <span class="error text-danger"> {{ $errors->first('fb_link') }} </span>
                      </div>

                      <div class="form-group">
                          <label>Upload Photo</label>
                          <input type="file" name="photo" value="" class="form-control mb-1" />
                          <code><i class="fa fa-circle-exclamation"></i>Max 1MB</code>
                      </div>
                      
                      <button type="submit" class="btn btn-signup">Register</button>
                      
                    </form>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

  <script type="text/javascript">
        $(document).ready(function () {

            $("#password").on('keyup', function(){
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#password').val().length < 6) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
            } else {
                if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters or some combination.)");
                }
            }
            });
        });


        function checkPass(){

            var password = document.getElementById('password');
            var password_confirmation = document.getElementById('password_confirmation');
            var message = document.getElementById('confirmMessage');
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            if(password.value == password_confirmation.value){
                password_confirmation.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Congrates, Password Match !"
            }else{
                password_confirmation.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Sorry, Password Does Not Match !"
            }
        }



    </script>

@endsection
