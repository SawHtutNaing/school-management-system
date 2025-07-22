@extends('admin.layout.layout')
@section('main-content')
    <div class="content-wrapper" style="background-color: #eef3f9;">
        <div class="content-header py-3">
            <div class="container-fluid">
                <h1 class="text-primary"><b>Admin Dashboard</b></h1>
            </div>
        </div>

        <div class="container my-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Add Student Marks</h4>
                </div>
                <div class="card-body bg-light rounded-bottom-4 p-4">
                    <form action="{{ route('admin.results.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student</label>
                            <select name="student_id" id="student_id" class="form-select" required>
                                <option value="" disabled selected>Select a student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->student_no }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="form-label">Class</label>
                            <input type="text" id="class_info" class="form-control mt-3" readonly>
                            <input type="hidden" name="class_id" id="class_id">
                        </div>

                        <div class="mb-3">
                            <label for="subject_id" class="form-label">Subjects</label>
                            {{-- <select name="subject_id" id="subject_id" class="form-select" required>
                                <option value="" disabled selected>Select a subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->code }})</option>
                                @endforeach
                            </select> --}}

                            <!-- Dynamic Subject Marks Input -->
                            <div id="subject-marks-container" class="mt-4"></div>

                        </div>


                        {{-- <div class="mb-3">
                            <label for="marks" class="form-label">Marks (0 - 100)</label>
                            <input type="number" name="marks" id="marks" class="form-control" min="0"
                                max="100" placeholder="Enter marks" required>
                        </div> --}}
                        {{-- <div class="mt-4">
                            <label>Calculated GPA / Grade:</label>
                            <input type="text" id="gpa" class="form-control" readonly>
                        </div> --}}

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2 px-4">💾 Save</button>
                            <a href="{{ route('admin.results.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('student_id').addEventListener('change', async function() {
            const studentId = this.value;
            const res = await fetch(`http://localhost:8000/api/student-data/${studentId}`);
            const data = await res.json();

            // Fill in class info
            const classInfo = data.class;
            document.getElementById('class_info').value =
                `${classInfo.name} / ${classInfo.term} / ${classInfo.section}`;
            document.getElementById('class_id').value = classInfo.id;

            // Build subject inputs
            const container = document.getElementById('subject-marks-container');
            container.innerHTML = '';

            data.subjects.forEach((subject) => {
                const row = `
            <div class="mb-3">
                <label class="form-label">${subject.subject.name} (${subject.subject.code})</label>
                <div class="d-flex gap-3">
                    <input type="number" 
                           name="marks[${subject.subject.id}]" 
                           class="form-control subject-mark" 
                           data-subject="${subject.subject.name}" 
                           data-target="gpa-${subject.subject.id}" 
                           min="0" max="100" 
                           placeholder="Enter marks for ${subject.subject.name}" 
                           required>

                    <input type="text" 
                           id="gpa-${subject.subject.id}" 
                           class="form-control text-muted" 
                           placeholder="Grade" 
                           readonly>
                </div>
            </div>
        `;
                container.insertAdjacentHTML('beforeend', row);
            });
        });

        // Listen to input changes on all future GPA fields
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('subject-mark')) {
                const mark = parseFloat(e.target.value);
                const targetId = e.target.getAttribute('data-target');
                const gpaInput = document.getElementById(targetId);

                if (!isNaN(mark)) {
                    const grade = getGrade(mark);
                    gpaInput.value = `${mark} (${grade})`;
                } else {
                    gpaInput.value = '';
                }
            }
        });

        function getGrade(mark) {
            if (mark >= 90) return 'A+';
            if (mark >= 80) return 'A';
            if (mark >= 75) return 'B+';
            if (mark >= 70) return 'B';
            if (mark >= 60) return 'C';
            if (mark >= 50) return 'D';
            return 'F';
        }
    </script>
@endsection
