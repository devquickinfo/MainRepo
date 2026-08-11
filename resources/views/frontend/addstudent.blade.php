@extends('frontend.layout.applayout')
@section('title', 'Add Student')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Student</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Student</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">{{ isset($student) ? 'EDIT STUDENT' : 'ADD STUDENT' }}</h3>
                <!-- <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary">Add New</a> -->
              </div>
              @if(session('success'))
                <div class="alert alert-success m-3 mb-0">
                  {{ session('success') }}
                </div>
              @endif
              @if(session('error'))
                <div class="alert alert-danger m-3 mb-0">
                  {{ session('error') }}
                </div>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form id="quickForm" action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($student))
                  @method('PUT')
                @endif
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Admission No</label>
                        <input type="text" name="admission_no" class="form-control" id="exampleInputEmail1" placeholder="Enter Admission No" value="{{ old('admission_no', $student->admission_no ?? '') }}">
                        @error('admission_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="exampleInputPassword1" placeholder="Enter First Name" value="{{ old('first_name', $student->first_name ?? '') }}">
                        @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                   
                      <div class="form-group">
                        <label for="exampleInputPassword2">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="exampleInputPassword2" placeholder="Enter Last Name" value="{{ old('last_name', $student->last_name ?? '') }}">
                      </div>
                  
                      <div class="form-group">
                        <label for="exampleInputPassword2">Father Name</label>
                        <input type="text" name="father_name" class="form-control" id="exampleInputPassword2" placeholder="Enter Father Name" value="{{ old('father_name', $student->father_name ?? '') }}">
                        @error('father_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                   
                      <div class="form-group">
                        <label for="exampleInputEmail1">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">-- Select Gender --</option>
                            <option value="Male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $student->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputPassword1">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" id="exampleInputPassword1" placeholder="Enter Date of Birth" value="{{ old('date_of_birth', optional($student->date_of_birth ?? null)->format('Y-m-d') ?? '') }}">
                        @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword2">Class</label>
                          <select name="class_id" id="class_id" class="form-control" required>
                                  <option value="">Select Class</option>

                                  @foreach($classes as $class)
                                      <option value="{{ $class->id }}" {{ old('class_id', $student->class_id ?? '') == $class->id ? 'selected' : '' }}>
                                          {{ $class->name }}
                                      </option>
                                  @endforeach
                          </select>
                          @error('class_id')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword2">Section</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="">Select Section</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" data-class-id="{{ $section->class_id }}" {{ old('section_id', $student->section_id ?? '') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                       <div class="form-group">
                        <label for="exampleInputPassword2">Blood Group</label>
                        <input type="text" name="blood_group" class="form-control" id="exampleInputPassword2" placeholder="Enter Blood Group" value="{{ old('blood_group', $student->blood_group ?? '') }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword2">Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPassword2" placeholder="Enter Phone" value="{{ old('phone', $student->phone ?? '') }}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword2">Photo Upload</label>
                        <input type="file" name="photo" class="form-control" id="exampleInputPassword2" placeholder="Upload Photo">
                      </div>
                      @if(isset($student) && $student->photo)
                        <div class="form-group">
                            <label>Current Upload Photo:</label><br>
                            <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" style="max-width: 150px; max-height: 150px;">
                        </div>
                      @endif
                      @if(isset($student) && $student->capturephoto)
                        <div class="form-group">
                            <label>Current Capture Photo:</label><br>
                            <img src="{{ asset('storage/' . $student->capturephoto) }}" alt="Captured Student Photo" style="max-width: 150px; max-height: 150px;">
                        </div>
                      @endif
                      @error('photo')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-9">
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
                      <div class="form-group">
                        <label for="exampleInputPassword2">Address</label>
                        <textarea name="address" class="form-control" rows="5" id="exampleInputPassword2" placeholder="Enter Address">{{ old('address', $student->address ?? '') }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Submit' }}</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <!-- <div class="card card-secondary mt-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Student List</h3>
                <a href="{{ route('students.create') }}" class="btn btn-sm btn-primary">Add Student</a>
              </div>
              <div class="card-body">
                @if($students->isEmpty())
                  <p class="text-muted">No students found.</p>
                @else
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Admission No</th>
                          <th>Name</th>
                          <th>Class</th>
                          <th>Section</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($students as $studentItem)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $studentItem->admission_no }}</td>
                            <td>{{ $studentItem->first_name }} {{ $studentItem->last_name }}</td>
                            <td>{{ $studentItem->studentClass->name ?? '-' }}</td>
                            <td>{{ $studentItem->section->name ?? '-' }}</td>
                            <td>
                              <a href="{{ route('students.edit', $studentItem->id) }}" class="btn btn-sm btn-warning">Edit</a>
                              <form action="{{ route('students.destroy', $studentItem->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this student?')">Delete</button>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="mt-3">
                    {{ $students->links() }}
                  </div>
                @endif
              </div>
            </div> -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const classSelect = document.getElementById('class_id');
        const sectionSelect = document.getElementById('section_id');

        function filterSections() {
            const selectedClassId = classSelect.value;
            Array.from(sectionSelect.querySelectorAll('option[data-class-id]')).forEach(function (option) {
                option.style.display = selectedClassId && option.getAttribute('data-class-id') !== selectedClassId ? 'none' : '';
                if (selectedClassId && option.getAttribute('data-class-id') !== selectedClassId) {
                    option.disabled = true;
                } else {
                    option.disabled = false;
                }
            });

            if (!selectedClassId) {
                sectionSelect.value = '';
            }
        }

        if (classSelect && sectionSelect) {
            filterSections();
            classSelect.addEventListener('change', filterSections);
        }
    });
</script>
@endsection  