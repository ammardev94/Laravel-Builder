<div class='btn-group'>
    <a href="{{ route('admin.vtc_students.show', $student->id) }}" class="btn btn-default btn-sm">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{ route('admin.vtc_students.edit', $student->id) }}" class="btn btn-default btn-sm">
        <i class="fas fa-edit"></i>
    </a>
    <form class="delete-student-form" action="{{ route('admin.vtc_students.destroy', $student->id) }}" method="POST" style="display:inline;">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-default btn-sm">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
