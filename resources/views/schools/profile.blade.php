@extends('frontend.layout.applayout')
@section('title', 'School Profile')
@section('content')
<style>
  .school-readonly {
        background-color: #495057 !important;
        color: #fff !important;
        cursor: not-allowed;
    }

    .school-readonly:hover {
        background-color: #495057 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
              
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0">
                        Update your school and account details
                    </h3>

                    <a href="{{ url()->previous() }}"
                    class="btn btn-secondary btn-sm ml-auto">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('school.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>School Name</label>
                                    <input type="text" name="school_name" class="form-control {{ Auth::user()?->role === 'school' ? 'school-readonly' : '' }}" value="{{ old('school_name', $school->school_name) }}" @if(Auth::user()?->role === 'school') readonly @endif>
                                    @error('school_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>School Code</label>
                                    <input type="text" name="school_code" class="form-control {{ Auth::user()?->role === 'school' ? 'school-readonly' : '' }}" value="{{ old('school_code', $school->school_code) }}" @if(Auth::user()?->role === 'school') readonly @endif>
                                    @error('school_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Principal Name</label>
                                    <input type="text" name="principal_name" class="form-control" value="{{ old('principal_name', $schoolUser?->name ?? '') }}">
                                    @error('principal_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $school->phone) }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $school->email) }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ old('username', $schoolUser?->email ?? '') }}">
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" autocomplete="new-password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" name="school_logo" class="form-control">
                                </div>
                                @error('school_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control" rows="4">{{ old('address', $school->address) }}</textarea>
                                </div>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
