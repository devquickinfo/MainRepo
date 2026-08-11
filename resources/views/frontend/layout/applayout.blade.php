<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/dist/img/schoolid1.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('frontend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
  <style>
    /* .content-wrapper {
        margin-left: 0 !important;
    }
    .main-header {
        margin-left: 0 !important;
    }
    .main-footer {
        margin-left: 0 !important;
    } */
  </style>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed text-sm">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/dashboard')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('frontend/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('frontend/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('frontend/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"> {{ ucwords(Auth::user()->name) }}</i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{ route('school.profile') }}" class="dropdown-item">
            <i class="fas fa-school mr-2"></i> School Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('user.logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
          </a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{asset('frontend/dist/img/schoolid.jpg')}}" alt="School ID Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">School ID Card</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(session('role') !== 'school')
          <li class="nav-item">
            <a href="{{ Auth::user()->role === 'school' ? route('schools.show', Auth::user()->school_id) : route('schools.index') }}" class="nav-link {{ request()->routeIs('schools.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-school"></i>
              <p>
                School
              </p>
            </a>
          </li>
          @endif
          @if(session('role') === 'school')
          {{--<li class="nav-item">
            <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
               Add New Student
              </p>
            </a>
          </li>--}}
          <li class="nav-item">
            <a href="{{ route('student.list') }}" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
              Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('idcard.create') }}" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Create ID Card
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('student.import') }}" class="nav-link {{ request()->routeIs('students.import.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-import"></i>
              <p>
               Import Students
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('teacher.list') }}" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Teachers
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
              <a href="{{ route('upload-samples.index') }}"
                class="nav-link {{ request()->routeIs('upload-samples.*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-id-card"></i>
                  <p>
                    @if(session('role') === 'school')
                    Card Sample
                    @else
                      Upload Sample
                    @endif
                  </p>
              </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>




  @yield('content')







  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
<!--   <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="">IDCard</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer> -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('frontend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('frontend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('frontend/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('frontend/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('frontend/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('frontend/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('frontend/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('frontend/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('frontend/dist/js/pages/dashboard2.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
 <script>
  
  $(document).ready(function () {
      $('#class_id').on('change', function () {

          let classId = $(this).val();

          $('#section_id').html('<option value="">Select Section</option>');

          if (classId) {
              $.ajax({
                  url: '/sections/' + classId,
                  type: 'GET',
                  success: function (response) {

                      $.each(response, function (index, section) {
                          $('#section_id').append(
                              '<option value="' + section.id + '">' + section.name + '</option>'
                          );
                      });

                  }
              });
          }
      });

  });
</script>
<!-- <script>
let stream = null;
let video = null;

$('#start-camera').click(async function () {

    try {

        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }

        stream = await navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: $('#camera-facing-mode').val()
            },
            audio: false
        });

        video = document.createElement('video');
        video.autoplay = true;
        video.playsInline = true;
        video.srcObject = stream;

        $('#camera-feed').html(video);

    } catch (e) {
        alert('Unable to access camera.');
        console.log(e);
    }

});

$('#capture-photo').click(function () {

    if (!video) {
        alert('Start camera first.');
        return;
    }

    const canvas = document.createElement('canvas');

    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    const ctx = canvas.getContext('2d');

    ctx.drawImage(video, 0, 0);

    const image = canvas.toDataURL('image/png');

    $('#photo_data').val(image);

    $('#camera-preview').html(
        '<img src="'+image+'" style="width:100%;height:100%;object-fit:cover;">'
    );

});
</script> -->

<script>
  let stream = null;

  async function startCamera() {

      if (stream) {
          stream.getTracks().forEach(track => track.stop());
      }

      const facingMode = document.getElementById('camera-facing-mode').value;

      try {
          stream = await navigator.mediaDevices.getUserMedia({
              video: {
                  facingMode: { ideal: facingMode }
              },
              audio: false
          });

          const video = document.createElement('video');
          video.autoplay = true;
          video.playsInline = true;
          video.muted = true;
          video.srcObject = stream;
          video.style.width = "100%";
          video.style.height = "100%";
          video.style.objectFit = "cover";

          document.getElementById('camera-feed').innerHTML = "";
          document.getElementById('camera-feed').appendChild(video);

          await video.play();
          if (video.videoWidth && video.videoHeight) {
              video.style.width = "100%";
              video.style.height = "100%";
          }

      } catch (err) {
          console.error(err);
          console.log(err.name + "\n" + err.message);
      }
  }

  // Start button
  document.getElementById('start-camera').addEventListener('click', startCamera);

  // Change camera (Front/Back)
  document.getElementById('camera-facing-mode').addEventListener('change', startCamera);

  // Capture
  document.getElementById('capture-photo').addEventListener('click', function () {

      const video = document.querySelector('#camera-feed video');

      if (!video) {
          alert("Please start the camera first.");
          return;
      }

      const canvas = document.createElement('canvas');
      canvas.width = video.videoWidth || 640;
      canvas.height = video.videoHeight || 480;

      const ctx = canvas.getContext('2d');
      ctx.drawImage(video, 0, 0);

      const image = canvas.toDataURL("image/png");

      document.getElementById('photo_data').value = image;

      document.getElementById('camera-preview').innerHTML =
          '<img src="' + image + '" style="width:100%;height:100%;object-fit:cover;">';
  });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchInput = document.getElementById('studentSearch');
        var tableRows = Array.from(document.querySelectorAll('#studentTable tbody tr'));

        if (!searchInput || tableRows.length === 0) {
            return;
        }

        searchInput.addEventListener('keyup', function () {
            var value = this.value.trim().toLowerCase();

            tableRows.forEach(function (row) {
                var admissionNo = row.cells[0].textContent.toLowerCase();
                var name = row.cells[1].textContent.toLowerCase();
                var phone = row.cells[3].textContent.toLowerCase();

                if (value.length < 3) {
                    row.style.display = '';
                } else {
                    var matches = admissionNo.indexOf(value) > -1 || name.indexOf(value) > -1 || phone.indexOf(value) > -1;
                    row.style.display = matches ? '' : 'none';
                }
            });
        });
    });
</script>
<script>
  $(document).on('change', '#selectAll', function () {
      $('.student-checkbox').prop('checked', this.checked);
  });

  $(document).on('change', '.student-checkbox', function () {
      $('#selectAll').prop(
          'checked',
          $('.student-checkbox').length === $('.student-checkbox:checked').length
      );
  });

  $("#upload-samples-btn").on("click", function () {

      if (sampleDropzone.files.length === 0) {
          alert("Please select at least one image.");
          return;
      }
      sampleDropzone.processQueue();
  });
  Dropzone.autoDiscover = false;
  const sampleDropzone = new Dropzone("#sample-dropzone", {

      url: "{{ route('upload-samples.store') }}",

      paramName: "upload_samples",

      method: "POST",
      autoProcessQueue: false, 

      uploadMultiple: false,
      parallelUploads: 8,

      acceptedFiles: "image/*",
      maxFilesize: 40,

      addRemoveLinks: true,

      headers: {
          "X-CSRF-TOKEN": document
              .querySelector('meta[name="csrf-token"]')
              .getAttribute("content")
      },

      // Add fields to each Dropzone preview
      init: function () {

          this.on("addedfile", function (file) {

              let preview = $(file.previewElement);

              preview.append(`
                  <div class="sample-fields mt-2">

                      <input
                          type="text"
                          class="form-control form-control-sm sample-name mb-2"
                          placeholder="Image Name"
                          value="${file.name}"
                      >

                      <input
                          type="text"
                          class="form-control form-control-sm sample-caption mb-2"
                          placeholder="Caption"
                      >

                      <select
                          class="form-control form-control-sm sample-orientation"
                      >
                          <option value="horizontal">
                              Horizontal
                          </option>

                          <option value="vertical">
                              Vertical
                          </option>
                      </select>

                  </div>
              `);
          });

          this.on("sending", function (file, xhr, formData) {

              let preview = $(file.previewElement);

              let imageName = preview
                  .find(".sample-name")
                  .val() || file.name;

              let caption = preview
                  .find(".sample-caption")
                  .val() || "";

              let orientation = preview
                  .find(".sample-orientation")
                  .val() || "horizontal";

              formData.append("image_name", imageName);
              formData.append("caption", caption);
              formData.append("orientation", orientation);

              console.log("========== FORMDATA ==========");

              for (let pair of formData.entries()) {
                  console.log(
                      pair[0],
                      pair[1],
                      pair[1] instanceof File
                  );
              }
          });

          this.on("queuecomplete", function () {
              console.log("All files uploaded successfully.");
              window.location.href = "{{ route('upload-samples.index') }}";

          });

          this.on("error", function (file, error) {

              console.log("ERROR:", error);
          });
      }
  });
  
</script>
 <script>
    $(document).on('change', '.sample-radio', function () {
        $('#selected-sample-id').val($(this).val());
    });
</script>

</body>
</html>
