<a href="{{ route('job-positions.edit', ['job_position' => $id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
<a href="#" data-action="{{ route('job-positions.destroy', ['job_position' => $id]) }}" class="btn btn-sm btn-danger btn-crud-delete" onclick="crudDelete(this)"><i class="fas fa-trash"></i></a>
