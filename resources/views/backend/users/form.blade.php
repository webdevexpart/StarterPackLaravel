@extends('layouts.backend.app')

@section('title', isset($user) ? 'Edit User' : 'Create User')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
    <style>
        .dropify-wrapper .dropify-message p{
            font-size: initial;
        }
    </style>
@endpush
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($user) ? 'Edit' : 'Create' }} User</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.users.index') }}" class="btn-shadow mr-3 btn btn-danger">
                    <i class="fas fa-arrow-circle-left"></i>
                    <span class="ml-1">Back to list</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ isset($user) ? route('app.users.update',$user->id) : route('app.users.store') }}" enctype="multipart/form-data">
                @csrf
                @isset($user)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">User Info</h5>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" required autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email"  type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" required autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" {{ !isset($user) ? 'required' : '' }} autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input id="confirm_password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" {{ !isset($user) ? 'required' : '' }} autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>
                                <div class="form-group">
                                    <label for="role">Select Role</label>
                                    <select name="role" id="role" class="form-control js-example-basic-single @error('role') is-invalid @enderror" required>
                                        <option value="">Click here to select role</option>
                                        @foreach($roles as $key => $role)
                                            <option value="{{ $role->id }}" @isset($user) {{ $user->role->id == $role->id ? 'selected' : ''}} @endisset >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="role">Avatar</label>
                                    <input id="avatar" type="file" class="dropify form-control @error('avatar') is-invalid @enderror" name="avatar" data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : '' }}" {{ !isset($user) ? 'required' : '' }} autofocus>
                                    @error('avatar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($user)
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span class="ml-1">Update</span>
                                    @else
                                        <i class="fas fa-plus-circle"></i>
                                        <span class="ml-1">Create</span>
                                    @endisset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.dropify').dropify();
        });
    </script>
@endpush
