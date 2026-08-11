@extends('frontend.layout.applayout')

@section('title', 'Create ID Card')

@section('content')

<div class="content-wrapper">
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create ID Card</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Create ID Card
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">

        <!-- Filter Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-id-card mr-2"></i>
                    ID Card Filters
                </h3>
            </div>

            <div class="card-body">

                <form action="{{ route('idcard.create') }}" method="GET" id="idCardFilterForm" enctype="multipart/form-data">

                    <div class="row">

                        <!-- Class -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class_id">Class</label>

                                <select name="class_id"
                                        id="class_id"
                                        class="form-control" onchange="this.form.submit()">
                                    <option value="">All Classes</option>

                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Section -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">Section</label>

                                <select name="section_id"
                                        id="section_id"
                                        class="form-control" onchange="this.form.submit()">
                                    <option value="">All Sections</option>

                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Background Template -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="background_template">
                                    Background Template
                                </label>

                                <select name="background_template"
                                        id="background_template"
                                        class="form-control" onchange="this.form.submit()">>

                                    <!-- <option value="">All Templates</option> -->

                                    <option value="sky_blue"
                                        {{ request('background_template') == 'sky_blue' ? 'selected' : '' }}>
                                        Sky Blue
                                    </option>

                                    <option value="blue"
                                        {{ request('background_template') == 'blue' ? 'selected' : '' }}>
                                        Blue
                                    </option>

                                    <option value="green"
                                        {{ request('background_template') == 'green' ? 'selected' : '' }}>
                                        Green
                                    </option>

                                    <option value="red"
                                        {{ request('background_template') == 'red' ? 'selected' : '' }}>
                                        Red
                                    </option>

                                    <option value="custom"
                                        {{ request('background_template') == 'custom' ? 'selected' : '' }}>
                                        Custom
                                    </option>

                                </select>
                            </div>
                        </div>

                        <!-- Card Orientation -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="orientation">
                                    Card Orientation
                                </label>

                                <select name="orientation"
                                        id="orientation"
                                        class="form-control" onchange="this.form.submit()">

                                   <!--  <option value="">All Orientations</option> -->

                                    <option value="vertical"
                                        {{ request('orientation') == 'vertical' ? 'selected' : '' }}>
                                        Vertical (54mm x 84mm)
                                    </option>

                                    <option value="horizontal"
                                        {{ request('orientation') == 'horizontal' ? 'selected' : '' }}>
                                        Horizontal
                                    </option>

                                </select>
                            </div>
                        </div>

                        <!-- Photo -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="photo">
                                    Photo
                                </label>

                                <select name="photo"
                                        id="photo"
                                        class="form-control" onchange="this.form.submit()">

                                    <option value="">All Students</option>

                                    <option value="available"
                                        {{ request('photo') == 'available' ? 'selected' : '' }}>
                                        Photo Available
                                    </option>

                                    <option value="not_available"
                                        {{ request('photo') == 'not_available' ? 'selected' : '' }}>
                                        No Photo
                                    </option>

                                </select>
                            </div>
                        </div>

                        <!-- ID Card Printed -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="printed">
                                    ID Card Printed
                                </label>

                                <select name="printed"
                                        id="printed"
                                        class="form-control" onchange="this.form.submit()">

                                    <option value="">All</option>

                                    <option value="yes"
                                        {{ request('printed') == 'yes' ? 'selected' : '' }}>
                                        Yes
                                    </option>

                                    <option value="no"
                                        {{ request('printed') == 'no' ? 'selected' : '' }}>
                                        No
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                          <div class="form-group"> 
                            <label for="student_search">Search Student</label> 
                            <input type="text" name="student_search" id="student_search" class="form-control" placeholder="Name or Admission No" autocomplete="off" value="{{ request('student_search') ?? request('search') }}"> 
                            <small class="text-muted"> Type at least 3 characters </small> 
                           </div> 
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <button type="submit"
                                    class="btn btn-primary">
                                <i class="fas fa-search mr-1"></i>
                                Search
                            </button>

                            <a href="{{ route('idcard.create') }}"
                               class="btn btn-secondary">
                                <i class="fas fa-sync-alt mr-1"></i>
                                Reset
                            </a>

                        </div>
                    </div>

                </form>

            </div>
        </div>


        <!-- Student List -->
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users mr-2"></i>
                    Students
                </h3>

                <div class="card-tools">
                    <span class="badge badge-info">
                        {{ $students->total() ?? $students->count() }} Students
                    </span>
                </div>
            </div>

            <div class="card-body p-0">

                <form action="{{ route('idcard.generate') }}"
                      method="POST"
                      id="generateIdCardForm" target="_blank">

                    @csrf

                    <input type="hidden"
                           name="background_template"
                           id="backgroundTemplateInput"
                           value="{{ request('background_template') }}">

                    <input type="hidden"
                           name="orientation"
                           id="orientationInput"
                           value="{{ request('orientation') }}">

                    <div id="selectedStudentIdsContainer"></div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover mb-0">

                            <thead>
                                <tr>
                                    <th width="40">
                                        <div class="icheck-primary">
                                            <input type="checkbox"
                                                   id="selectAll">
                                            <label for="selectAll"></label>
                                        </div>
                                    </th>

                                    <th width="80">Photo</th>
                                    <th>Admission No</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <!-- <th>Photo</th> -->
                                    <th>ID Card Printed</th>
                                </tr>
                            </thead>

                            <tbody id="studentTableBody">
                                @include('schools.partials.student_rows', ['students' => $students])
                            </tbody>

                        </table>

                    </div>

                    @if(optional($students)->count() > 0)

                        <div class="card-footer">

                            <div class="row align-items-center">

                                <div class="col-md-6">

                                    <span id="selectedCount">
                                        0 students selected
                                    </span>

                                </div>

                                <div class="col-md-6 text-right">

                                    <button type="submit"
                                            class="btn btn-success"
                                            id="generateButton">

                                        <i class="fas fa-id-card mr-1"></i>
                                        Generate ID Cards

                                    </button>

                                </div>

                            </div>

                        </div>

                    @endif

                </form>

            </div>

            @if(method_exists($students, 'links'))

                <div class="card-footer">
                    {{ $students->withQueryString()->links() }}
                </div>

            @endif

        </div>

    </div>
</section>


</div>
@endsection

@push('scripts')

<script>

$(document).ready(function () {

    let searchTimer;

    // Select / deselect all students
    $('#selectAll').on('change', function () {

        $('.student-checkbox').prop(
            'checked',
            $(this).is(':checked')
        );

        updateSelectedCount();
    });

    // Individual checkbox
    $(document).on('change', '.student-checkbox', function () {

        let total = $('.student-checkbox').length;
        let checked = $('.student-checkbox:checked').length;

        $('#selectAll').prop(
            'checked',
            total > 0 && total === checked
        );

        updateSelectedCount();
    });

    function updateSelectedCount() {

        let selected = $('.student-checkbox:checked').length;

        $('#selectedCount').text(
            selected + ' student' + (selected !== 1 ? 's' : '') + ' selected'
        );

        $('#generateButton').prop(
            'disabled',
            selected === 0
        );
    }

    function syncGenerationInputs() {
        $('#backgroundTemplateInput').val($('#background_template').val());
        $('#orientationInput').val($('#orientation').val());

        let selectedIds = [];
        $('.student-checkbox:checked').each(function () {
            selectedIds.push($(this).val());
        });

        $('#selectedStudentIdsContainer').empty();
        selectedIds.forEach(function (id) {
            $('#selectedStudentIdsContainer').append(
                $('<input>', {
                    type: 'hidden',
                    name: 'student_ids[]',
                    value: id
                })
            );
        });
    }

    function loadStudents() {
        let formData = $('#idCardFilterForm').serialize();
        let searchTerm = $('#student_search').val().trim();

        $('#studentTableBody').html(`
            <tr>
                <td colspan="8" class="text-center py-4">
                    <i class="fas fa-spinner fa-spin fa-2x text-muted mb-2"></i>
                    <p class="mb-0 text-muted">Searching students...</p>
                </td>
            </tr>
        `);

        $.ajax({
            url: '{{ route('idcard.search.students') }}',
            type: 'GET',
            data: formData + '&search=' + encodeURIComponent(searchTerm),
            success: function (response) {
                $('#studentTableBody').html(response);
                updateSelectedCount();
            },
            error: function () {
                $('#studentTableBody').html(`
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger mb-2"></i>
                            <p class="mb-0 text-muted">Unable to load students right now.</p>
                        </td>
                    </tr>
                `);
            }
        });
    }

    $('#student_search').on('keyup', function () {
        clearTimeout(searchTimer);

        let searchTerm = $(this).val().trim();

        if (searchTerm.length > 0 && searchTerm.length < 3) {
            return;
        }

        searchTimer = setTimeout(loadStudents, 300);
    });

    $('#background_template, #orientation').on('change', function () {
        syncGenerationInputs();
    });

    // $('#generateIdCardForm').on('submit', function (e) {
    //     syncGenerationInputs();

    //     if ($('.student-checkbox:checked').length === 0) {
    //         e.preventDefault();
    //         alert('Please select at least one student.');
    //         return false;
    //     }

    //     return true;
    // });

    $('#idCardFilterForm').on('submit', function (e) {
        e.preventDefault();
        loadStudents();
    });

    $('#class_id, #section_id, #photo, #printed').on('change', function () {
        loadStudents();
    });

});

</script>
@endpush
