<a href="{{ route('articles.edit', ['article' => $id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
<a target="_blank" href="{{ config('app.frontend_base_url').'/news/'.$slug }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a>
<a href="#" data-action="{{ route('articles.destroy', ['article' => $id]) }}" class="btn btn-sm btn-danger btn-crud-delete" onclick="crudDelete(this)"><i class="fas fa-trash"></i></a>
