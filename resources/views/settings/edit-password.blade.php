@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Update Password</title>

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-6">
            <div class="card ">
                <div class="card-header card-header-info card-header-text ">
                    <div class="card-text">
                        <h3 class="card-title" id="titletable">Update Password</h3>
                    </div>
                </div>
                <div class="card-body ">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
                        @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach
                        <div class="form-group">
                            <label for="password" class="bmd-label-floating">Current Password</label>

                            <input id="password" type="password" class="form-control" name="password"
                                autocomplete="password">

                        </div>

                        <div class="form-group">
                            <label for="password" class="bmd-label-floating">New Password</label>

                            <input id="new_password" type="password" class="form-control" name="new_password"
                                autocomplete="current-password">

                        </div>

                        <div class="form-group">
                            <label for="password" class="bmd-label-floating">New Confirm
                                Password</label>

                            <input id="new_password_confirmation" type="password" class="form-control"
                                name="new_password_confirmation" autocomplete="current-password">

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <div class="box box-primary">
                 
                {!! Form::open(['url' => url('/settings/password'), 'method' => 'post']) !!}
                    <div class="box-body">

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', 'Password Lama') !!}

        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password lama']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('new_password') ? ' has-error' : '' }}">
        {!! Form::label('new_password', 'Password Baru') !!}

        {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'Password baru']) !!}
        {!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group has-feedback{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
        {!! Form::label('new_password_confirmation', 'Konfirmasi Password Baru') !!}

        {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'Konfirmasi
        password baru']) !!}
        {!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
</div> --}}
<!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->
@endsection
