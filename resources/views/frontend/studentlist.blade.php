@extends('frontend.layout.applayout')
@section('title', 'Sudent List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ @$class->name }} Students</h1>
                </div>
               {{----<div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('schools.show', @$school) }}">{{ @$school->school_name }}</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>----}} 
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title">Student List</h3>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary ml-auto">
                        Add Student
                    </a>
                </div>
                
                <div class="card-body">
                    <form method="GET" action="" class="row g-2 align-items-end mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Class</label>
                                <select name="class" class="form-control" onchange="this.form.submit()">
                                    <option value="">All Classes</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ request('class') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Section</label>
                                <select name="section" class="form-control" onchange="this.form.submit()">
                                    <option value="">All Sections</option>

                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ request('section') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        <div class="col-md-3">
                            <label class="form-label">ID Card Created</label>
                          <select name="idcardprinted" class="form-control" onchange="this.form.submit()">
                                <option value="">All Students</option>

                                <option value="yes"
                                    {{ request('idcardprinted') == 'yes' ? 'selected' : '' }}>
                                    Yes
                                </option>

                                <option value="no"
                                    {{ request('idcardprinted') == 'no' ? 'selected' : '' }}>
                                    No
                                </option>
                          </select>
                        </div>
                        <div class="col-md-3">
                        <label class="form-label">Student Photo</label>
                        <select name="student_photo" class="form-control" onchange="this.form.submit()">
                            <option value="">All Students</option>
                            <option value="with_photo" {{ request('student_photo') == 'with_photo' ? 'selected' : '' }}>With Photo</option>
                            <option value="without_photo" {{ request('student_photo') == 'without_photo' ? 'selected' : '' }}>Without Photo</option>
                        </select>
                        </div>
                    </form>

                   
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" id="studentSearch" class="form-control" placeholder="Search by Admission No, Name or Phone">
                            </div>
                        </div>
                        <table class="table table-bordered table-striped" id="studentTable">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Admission No</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Father Name</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                    <th>Card Printed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    <tr>
                                        <td>
                                            @if(!empty($student->photo))
                                                <img
                                                    src="{{ asset('storage/' . $student->photo) }}"
                                                    width="50"
                                                    height="50"
                                                    style="object-fit: cover;"
                                                >
                                            @elseif(!empty($student->capturephoto))
                                                <img
                                                    src="{{ asset('storage/' . $student->capturephoto) }}"
                                                    width="50"
                                                    height="50"
                                                    style="object-fit: cover;"
                                                >
                                            @else
                                                <span class="text-muted">No Photo</span>
                                            @endif
                                        </td>

                                        <td>{{ $student->admission_no }}</td>

                                        <td>
                                            {{ $student->first_name }}
                                            {{ $student->last_name }}
                                        </td>

                                        <td>
                                            {{ $student->section->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $student->father_name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $student->phone ?? '-' }}
                                        </td>

                                        <td>
                                            <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <a href="{{ route('students.show', $student->id) }}"
                                            class="btn btn-sm btn-info">
                                                View
                                            </a>
                                        </td>
                                       <td>
                                            @if($student->capturephoto == '')
                                                <button type="button"
                                                        class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#photoModal"
                                                        data-student-id="{{ $student->id }}"
                                                        data-photo="">
                                                    NO
                                                </button>
                                            @else
                                                <button type="button"
                                                        class="btn btn-sm btn-success"
                                                        data-toggle="modal"
                                                        data-target="#photoModal"
                                                        data-student-id="{{ $student->id }}"
                                                        data-photo="{{ asset('storage/' . $student->capturephoto) }}">
                                                    Yes
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No students found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="mt-3">
                                {{ $students->links() }}
                            </div>
                        </div>
                      
                    
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="photoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                   Capture Student Photo
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-center">

                <div id="modalPhotoContent">
                    <div class="col-md-12">
                      <h3>Capture Photo (Laptop/Mobile)</h3>
                      <p>Capture frame is fixed to passport size ratio 3.5cm x 4.5cm. Captured area keeps original crop pixels with no downscaling.</p>
                      <div class="row mt-3">
                        <!-- Live Camera -->
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Live Camera</h3>
                                </div>

                                <div class="card-body">

                                    <div id="camera-stage"
                                        style="background:#dbeafe;padding:8px;border-radius:8px;">

                                        <div id="camera"
                                            style="position:relative;aspect-ratio:3/4;background:#fff;border-radius:8px;overflow:hidden;">

                                            <div id="camera-feed"
                                                style="position:absolute;inset:0;">
                                            </div>

                                            <div id="capture-frame"
                                                style="position:absolute;
                                                        left:50%;
                                                        top:50%;
                                                        width:62%;
                                                        aspect-ratio:35/45;
                                                        transform:translate(-50%,-50%);
                                                        border:3px solid #000;
                                                        border-radius:12px;
                                                        box-shadow:0 0 0 9999px rgba(0,0,0,.25);
                                                        pointer-events:none;">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Captured Photo -->
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Captured Photo</h3>
                                </div>

                                <div class="card-body text-center">

                                    <div id="camera-preview"
                                        style="width:220px;
                                                height:280px;
                                                margin:auto;
                                                border:1px solid #ccc;
                                                border-radius:8px;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                overflow:hidden;
                                                background:#fff;">

                                        @if(isset($student) && $student->capturephoto)
                                            <img src="{{ asset('storage/' . $student->capturephoto) }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            No Capture
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Camera Settings -->
                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Camera Settings</h3>
                                </div>

                                <div class="card-body">

                                    <div class="form-group">
                                        <label>Capture Background</label>
                                        <select id="camera-bg" name="capture_background" class="form-control">
                                            <option value="#dbeafe" {{ old('capture_background', $student->capture_background ?? 'Sky Blue') == '#dbeafe' ? 'selected' : '' }}>Sky Blue</option>
                                            <option value="#e2e8f0" {{ old('capture_background', $student->capture_background ?? 'Sky Blue') == '#e2e8f0' ? 'selected' : '' }}>Light Slate</option>
                                            <option value="#dcfce7" {{ old('capture_background', $student->capture_background ?? 'Sky Blue') == '#dcfce7' ? 'selected' : '' }}>Mint Green</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Camera</label>
                                        <select id="camera-facing-mode" class="form-control">
                                            <option value="user">Front Camera</option>
                                            <option value="environment" selected>Back Camera</option>
                                        </select>
                                    </div>

                                    <div class="form-group mt-4">

                                        <button type="button"
                                                id="start-camera"
                                                class="btn btn-primary btn-block">
                                            <i class="fas fa-video"></i>
                                            Start Camera
                                        </button>

                                    </div>

                                    <div class="form-group">

                                        <button type="button"
                                                id="capture-photo"
                                                class="btn btn-success btn-block">
                                            <i class="fas fa-camera"></i>
                                            Capture Photo
                                        </button>

                                    </div>

                                    <input type="hidden"
                                          name="photo_data"
                                          id="photo_data">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<script
  src="https://code.jquery.com/jquery-4.0.0.min.js"
  integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao="
  crossorigin="anonymous"></script>
<script>
    $('#photoModal').on('show.bs.modal', function (event) {

    let button = $(event.relatedTarget);

    let photo = button.data('photo');

    let content = '';

    if (photo) {

        content = `
            <img src="${photo}"
                 class="img-fluid rounded"
                 style="max-height:500px;">
        `;

    } else {

        content = `
            <div class="text-center py-5">
                <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No Photo Captured</h5>
            </div>
        `;

    }

    $('#modalPhotoContent').html(content);
    });
</script>
@endsection