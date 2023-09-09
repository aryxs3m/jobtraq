<a href="{{ route('locations.edit', ['location' => $id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
<a href="#" data-action="{{ route('locations.destroy', ['location' => $id]) }}" class="btn btn-sm btn-danger btn-crud-delete" onclick="crudDelete(this)"><i class="fas fa-trash"></i></a>
