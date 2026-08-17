@extends('frontend.layout.applayout')
@section('title', 'Add Student')
@section('content')
<style>

  .id-card-preview {
      position: relative;
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      overflow: hidden;
      border-radius: 8px;
      background: #fff;
      box-shadow: 0 4px 15px rgba(0,0,0,.25);
  }

  /* Background template */
  .id-card-template {
      display: block;
      width: 100%;
      height: auto;
  }

  /* =========================
     SCHOOL LOGO
  ========================= */

  .card-school-logo {
      position: absolute;
      top: 4%;
      left: 5%;
      width: 12%;
      aspect-ratio: 1 / 1;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 100%;
      overflow: hidden;
      z-index: 5;

  }

  .card-school-logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
  }

  .logo-placeholder {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 8px;
      font-weight: bold;
      color: #333;
  }

  /* =========================
     SCHOOL NAME & ADDRESS
  ========================= */

  .card-school-name {
      position: absolute;
      top: 3%;
      left: 20%;
      width: 75%;
      text-align: left;
      font-size: clamp(12px, 2vw, 22px);
      font-weight: 800;
      color: #173f7a;
      text-transform: uppercase;
      z-index: 5;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
  }

  .card-school-address {
      position: absolute;
      top: 13%;
      left: 20%;
      width: 75%;
      text-align: left;
      font-size: clamp(6px, 1vw, 11px);
      font-weight: 500;
      color: #555;
      z-index: 5;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
  }

  /* =========================
     STUDENT PHOTO
  ========================= */

  .card-student-photo {
      position: absolute;
      top: 50%;
      left: 5%;
      width: 22%;
      aspect-ratio: 3 / 4;
      background: #eee;
      border: 3px solid #fff;
      border-radius: 8px;
      overflow: hidden;
      z-index: 5;
      box-shadow: 0 3px 10px rgba(0,0,0,.25);
  }

  .card-student-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
  }

  .student-photo-placeholder {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      font-weight: bold;
      color: #777;
  }

  /* =========================
     STUDENT DETAILS
  ========================= */

  .card-student-details {
      position: absolute;
      top: 25%;
      left: 32%;
      width: 63%;
      z-index: 5;
      color: #173f7a;
      font-size: clamp(7px, 1.15vw, 14px);
      font-weight: 600;
  }

  .card-detail-row {
      display: flex;
      width: 100%;
      margin-bottom: 1.2%;
      line-height: 1.25;
  }

  .detail-label {
      width: 32%;
      font-weight: 800;
      flex-shrink: 0;
  }

  .detail-value {
      width: 68%;
      font-weight: 600;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
  }

  /* Mobile Responsive */
  @media (max-width: 767px) {
      .card-school-name {
          font-size: 14px;
      }
      .card-school-address {
          font-size: 7px;
      }
      .card-student-details {
          font-size: 8px;
      }
  }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
     
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h3 class="card-title">{{ isset($student) ? 'EDIT STUDENT' : 'ADD STUDENT' }}</h3>
                 <a href="{{ route('student.list') }}"
                      class="btn btn-secondary btn-sm ml-auto flex-shrink-0">
                          <i class="fas fa-arrow-left"></i>
                          <span class="d-none d-sm-inline ml-1">Back</span>
                  </a>
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
            <form id="quickForm"
              action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}"
              method="POST" enctype="multipart/form-data">
              @csrf
              @if(isset($student))
              @method('PUT')
              @endif
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admission No</label>
                      <input type="text" name="admission_no" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter Admission No"
                        value="{{ old('admission_no', $student->admission_no ?? '') }}">
                      @error('admission_no')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">First Name</label>
                      <input type="text" name="first_name" class="form-control" id="exampleInputPassword1"
                        placeholder="Enter First Name" value="{{ old('first_name', $student->first_name ?? '') }}">
                      @error('first_name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword2">Last Name</label>
                      <input type="text" name="last_name" class="form-control" id="exampleInputPassword2"
                        placeholder="Enter Last Name" value="{{ old('last_name', $student->last_name ?? '') }}">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword2">Father Name</label>
                      <input type="text" name="father_name" class="form-control" id="exampleInputPassword2"
                        placeholder="Enter Father Name" value="{{ old('father_name', $student->father_name ?? '') }}">
                      @error('father_name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Gender</label>
                      <select name="gender" id="gender" class="form-control">
                        <option value="">-- Select Gender --</option>
                        <option value="Male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : ''
                          }}>Male</option>
                        <option value="Female" {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : ''
                          }}>Female</option>
                        <option value="Other" {{ old('gender', $student->gender ?? '') == 'Other' ? 'selected' : ''
                          }}>Other</option>
                      </select>
                      @error('gender')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Date of Birth</label>
                      <input type="date" name="date_of_birth" class="form-control" id="exampleInputPassword1"
                        placeholder="Enter Date of Birth"
                        value="{{ old('date_of_birth', optional($student->date_of_birth ?? null)->format('Y-m-d') ?? '') }}">
                      @error('date_of_birth')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword2">Class</label>
                      <select name="class_id" id="class_id" class="form-control" required>
                        <option value="">Select Class</option>

                        @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id', $student->class_id ?? '') == $class->id ?
                          'selected' : '' }}>
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
                        <option value="{{ $section->id }}" data-class-id="{{ $section->class_id }}" {{ old('section_id',
                          $student->section_id ?? '') == $section->id ? 'selected' : '' }}>
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
                      <input type="text" name="blood_group" class="form-control" id="exampleInputPassword2"
                        placeholder="Enter Blood Group" value="{{ old('blood_group', $student->blood_group ?? '') }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword2">Phone</label>
                      <input type="text" name="phone" class="form-control" id="exampleInputPassword2"
                        placeholder="Enter Phone" value="{{ old('phone', $student->phone ?? '') }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword2">Photo Upload</label>
                      <input type="file" name="photo" class="form-control" id="exampleInputPassword2"
                        placeholder="Upload Photo">
                    </div>
                    @if(isset($student) && $student->photo)
                    <div class="form-group">
                      <label>Current Upload Photo:</label><br>
                      <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo"
                        style="max-width: 150px; max-height: 150px;">
                    </div>
                    @endif
                    @if(isset($student) && $student->capturephoto)
                    <div class="form-group">
                      <label>Current Capture Photo:</label><br>
                      <img src="{{ asset('storage/' . $student->capturephoto) }}" alt="Captured Student Photo"
                        style="max-width: 150px; max-height: 150px;">
                    </div>
                    @endif
                    @error('photo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                      <label for="exampleInputPassword2">Address</label>
                      <textarea name="address" class="form-control" rows="5" id="exampleInputPassword2"
                        placeholder="Enter Address">{{ old('address', $student->address ?? '') }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <h3>Capture Photo (Laptop/Mobile)</h3>
                    <p>Capture frame is fixed to passport size ratio 3.5cm x 4.5cm. Captured area keeps original crop
                      pixels with no downscaling.</p>
                    <div class="row mt-3">
                      <!-- Live Camera -->
                      <div class="col-md-3">
                        <div class="card card-primary">
                          <div class="card-header">
                            <h3 class="card-title">Live Camera</h3>
                          </div>
                          <div class="card-body">
                            <div id="camera-stage" style="background:#dbeafe;padding:8px;border-radius:8px;">
                              <div id="camera"
                                style="position:relative;aspect-ratio:3/4;background:#fff;border-radius:8px;overflow:hidden;">
                                <div id="camera-feed" style="position:absolute;inset:0;">
                                </div>
                                <div id="capture-frame" style="position:absolute;
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
                      <div class="col-md-3">
                        <div class="card card-success">
                          <div class="card-header">
                            <h3 class="card-title">Captured Photo</h3>
                          </div>
                          <div class="card-body text-center">
                            <div id="camera-preview" style="width:250px;
                                                height:325px;
                                                margin:auto;
                                                border:1px solid #ccc;
                                                border-radius:8px;
                                                display:flex;
                                                align-items:center;
                                                justify-content:center;
                                                overflow:hidden;
                                                background:#fff;">

                              @if(isset($student) && $student->capturephoto)
                              <img src="{{ asset('storage/' . $student->capturephoto) }}"
                                style="width:100%;height:100%;object-fit:cover;">
                              @else
                              No Capture
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Camera Settings -->
                      <div class="col-md-2">
                        <div class="card card-info">
                          <div class="card-header">
                            <h3 class="card-title">Camera Settings</h3>
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <label>Capture Background</label>
                              <select id="camera-bg" name="capture_background" class="form-control">
                                <option value="#dbeafe" {{ old('capture_background', $student->capture_background ??
                                  'Sky Blue') == '#dbeafe' ? 'selected' : '' }}>Sky Blue</option>
                                <option value="#e2e8f0" {{ old('capture_background', $student->capture_background ??
                                  'Sky Blue') == '#e2e8f0' ? 'selected' : '' }}>Light Slate</option>
                                <option value="#dcfce7" {{ old('capture_background', $student->capture_background ??
                                  'Sky Blue') == '#dcfce7' ? 'selected' : '' }}>Mint Green</option>
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
                              <button type="button" id="start-camera" class="btn btn-primary btn-block">
                                <i class="fas fa-video"></i>
                                Start Camera
                              </button>
                            </div>
                            <div class="form-group">
                              <button type="button" id="capture-photo" class="btn btn-success btn-block">
                                <i class="fas fa-camera"></i>
                                Capture Photo
                              </button>
                            </div>
                            <input type="hidden" name="photo_data" id="photo_data">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="card card-info">
                              <div class="card-header">
                                  <h3 class="card-title">Live ID Card Preview</h3>
                              </div>

                              <div class="card-body p-2">

                                  @if($idcardsample)

                                      <div class="id-card-preview">

                                          {{-- ID CARD TEMPLATE --}}
                                          <img
                                              src="{{ asset('storage/' . $idcardsample->file_path) }}"
                                              class="id-card-template"
                                              alt="ID Card Template"
                                          >

                                          {{-- SCHOOL LOGO --}}
                                          <div class="card-school-logo">
                                              @if(isset($school) && $school->logo)
                                                  <img
                                                      src="{{ asset('storage/' . $school->logo) }}"
                                                      alt="School Logo"
                                                  >
                                              @else
                                                  <div class="logo-placeholder">
                                                      LOGO
                                                  </div>
                                              @endif
                                          </div>

                                          {{-- SCHOOL NAME & ADDRESS --}}
                                          <div class="card-school-name">
                                              {{ $school->school_name ?? 'SCHOOL NAME' }}
                                          </div>
                                          <div class="card-school-address">
                                              {{ $school->address ?? 'Address' }}
                                          </div>

                                          {{-- STUDENT PHOTO --}}
                                          <div class="card-student-photo">
                                              @if(isset($student) && $student->capturephoto)
                                                  <img
                                                      src="{{ asset('storage/' . $student->capturephoto) }}"
                                                      id="cardStudentPhoto"
                                                      alt="Student Photo"
                                                  >
                                              @elseif(isset($student) && $student->photo)
                                                  <img
                                                      src="{{ asset('storage/' . $student->photo) }}"
                                                      id="cardStudentPhoto"
                                                      alt="Student Photo"
                                                  >
                                              @else
                                                  <div class="student-photo-placeholder">
                                                      PHOTO
                                                  </div>
                                              @endif
                                          </div>

                                          {{-- STUDENT DETAILS --}}
                                          <div class="card-student-details">

                                              <div class="card-detail-row">
                                                  <span class="detail-label">Name</span>
                                                  <span class="detail-value" id="cardStudentName">
                                                      {{ trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')) ?: 'Student Name' }}
                                                  </span>
                                              </div>

                                              <div class="card-detail-row">
                                                  <span class="detail-label">Father</span>
                                                  <span class="detail-value" id="cardFatherName">
                                                      {{ $student->father_name ?? 'Father Name' }}
                                                  </span>
                                              </div>

                                              <div class="card-detail-row">
                                                  <span class="detail-label">Admission</span>
                                                  <span class="detail-value" id="cardAdmissionNo">
                                                      {{ $student->admission_no ?? 'Admission No' }}
                                                  </span>
                                              </div>

                                              <div class="card-detail-row">
                                                  <span class="detail-label">Class</span>
                                                  <span class="detail-value" id="cardClass">
                                                      {{ $student->studentClass->name ?? 'Class' }}
                                                  </span>
                                              </div>
                                              <div class="card-detail-row">
                                                  <span class="detail-label">Section</span>
                                                  <span class="detail-value" id="cardSection">
                                                      {{ $student->section->name ?? 'Section' }}
                                                  </span>
                                              </div>

                                              <div class="card-detail-row">
                                                  <span class="detail-label">DOB</span>
                                                  <span class="detail-value" id="cardDob">
                                                      @if(isset($student) && $student->date_of_birth)
                                                          {{ $student->date_of_birth->format('d-m-Y') }}
                                                      @else
                                                          DOB
                                                      @endif
                                                  </span>
                                              </div>

                                             

                                              <div class="card-detail-row">
                                                  <span class="detail-label">Blood</span>
                                                  <span class="detail-value" id="cardBloodGroup">
                                                      {{ $student->blood_group ?? 'Blood Group' }}
                                                  </span>
                                              </div>

                                              <div class="card-detail-row">
                                                  <span class="detail-label">Phone</span>
                                                  <span class="detail-value" id="cardPhone">
                                                      {{ $student->phone ?? 'Phone' }}
                                                  </span>
                                              </div>

                                          </div>

                                      </div>

                                  @else

                                      <div class="alert alert-warning">
                                          No ID card sample selected.
                                      </div>

                                  @endif

                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ isset($student) ? 'Update' : 'Submit' }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="idCardImageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ID Card Sample</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                @if($idcardsample)
                    <img src="{{ asset('storage/' . $idcardsample->file_path) }}"
                         alt="ID Card Sample"
                         class="img-fluid"
                         style="max-height: 80vh;">
                @endif
            </div>
        </div>
    </div>
  </div>
</div>
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