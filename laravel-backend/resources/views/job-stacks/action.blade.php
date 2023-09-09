<a href="{{ route('job-stacks.edit', ['job_stack' => $id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
<a href="#" data-action="{{ route('job-stacks.destroy', ['job_stack' => $id]) }}" class="btn btn-sm btn-danger btn-crud-delete" onclick="crudDelete(this)"><i class="fas fa-trash"></i></a>

