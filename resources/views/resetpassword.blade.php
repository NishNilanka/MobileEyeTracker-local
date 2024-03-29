    <!-- Navbar -->
@extends('layouts.app')

    <!-- Reset Password Modal -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="/reset">
                        @csrf
                            <!-- Admins Name -->
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current password:</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" placeholder="••••••" required autofocus>
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New password:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••" name="password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm new password:</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" placeholder="••••••" name="password_confirmation">
                            </div>
                        </div><br>
                            <!-- Change Password Button -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
