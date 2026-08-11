@extends('frontend.layout.applayout')
@section('title', 'School Details')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>School Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">School</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0 badge badge-success">{{ $school->school_name }}</h3>
                    <h3 class="card-title ml-auto mb-0 badge badge-success">
                        Principal: {{ $school->principal_name }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($school->logo)
                                <img src="{{ Storage::disk('public')->url($school->logo) }}" alt="School Logo" class="img-thumbnail img-fluid">
                            @else
                                <p>No logo available.</p>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <p><strong>School Code:</strong> {{ $school->school_code }}</p>
                            <p><strong>Email:</strong> {{ $school->email }}</p>
                            <p><strong>Phone:</strong> {{ $school->phone }}</p>
                            <p><strong>Address:</strong> {{ $school->address }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>City:</strong> {{ $school->city }}</p>
                            <p><strong>State:</strong> {{ $school->state }}</p>
                            <p><strong>Pincode:</strong> {{ $school->pincode }}</p>
                            <p><strong>Status:</strong> {{ $school->status ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Classes & Sections</h3>
                </div>
                <div class="card-body">
                    @if($classes->isEmpty())
                        <p class="text-muted">No classes or sections found for this school.</p>
                    @else
                        <div class="row">
                            @foreach($classes as $class)
                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('schools.classes.students', ['school' => $school, 'class' => $class]) }}" class="text-decoration-none text-dark">
                                        <div class="card h-100 cursor-pointer">
                                            <div class="card-header bg-primary text-white d-flex align-items-center w-100">
                                                <h3 class="card-title mb-0 flex-grow-1">{{ $class->name }}</h3>
                                                <span class="badge bg-light text-dark ms-3">
                                                    {{ App\Models\Student::where('class_id', $class->id)->where('school_id', $school->id)->count() }} Students
                                                </span>
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0 text-muted">Click to view students</p>
                                                <p class="mb-0 mt-2 text-danger">
                                                    {{ App\Models\Student::where('class_id', $class->id)->where('school_id', $school->id)->whereNull('capturephoto')->count() }} students without capture photo
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
