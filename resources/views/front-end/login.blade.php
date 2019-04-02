@extends('front-end.masterpage.master')
@section('content')

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="error">
            <p>{{ $error }}</p>
        </div>
    @endforeach
@endif
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Đăng nhập</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <form method="POST" action="{{ route('postlogin') }}">
                            @csrf
                          
                            <!-- // hiển thị thông báo đăng ký thành công -->
                            @if(session()->has('registerSuccess')) 
                                        <div class="alert alert-success">
                                           {{  session()->get('registerSuccess') }} 
                                        </div>
                            @endif
                                <div class="form-group">
                                <?php 
                                      if(isset($mess)) {
                                        echo $mess;
                                    }
                                 ?>
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                               
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
  @endsection