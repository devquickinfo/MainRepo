@forelse($students as $student)
    <tr>
        <td>
            <div class="icheck-primary">
                <input type="checkbox"
                       class="student-checkbox"
                       name="student_ids[]"
                       value="{{ $student->id }}"
                       id="student_{{ $student->id }}">

                <label for="student_{{ $student->id }}"></label>
            </div>
        </td>

        <td class="text-center">
            @if($student->photo)
                <img src="{{ asset('storage/' . $student->photo) }}"
                     alt="Student Photo"
                     width="50"
                     height="50"
                     class="img-circle"
                     style="object-fit: cover;">
            @else
                <div class="text-muted">
                    <i class="fas fa-user-circle fa-2x"></i>
                </div>
            @endif
        </td>

        <td>{{ $student->admission_no }}</td>
        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
        <td>{{ $student->father_name }}</td>
        <td>{{ $student->studentClass->name ?? '-' }}</td>
        <td>{{ $student->section->name ?? '-' }}</td>
        <td>
            @if($student->idcardprinted === 'yes')
                <span class="badge badge-success">Yes</span>
            @else
                <span class="badge badge-danger">No</span>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center py-4">
            <i class="fas fa-users-slash fa-2x text-muted mb-2"></i>
            <p class="mb-0 text-muted">No students found.</p>
        </td>
    </tr>
@endforelse
