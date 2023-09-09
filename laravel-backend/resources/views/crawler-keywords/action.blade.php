<a href="{{ route('scraper-keywords.edit', ['scraper_keyword' => $id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i></a>
<a href="#" data-action="{{ route('scraper-keywords.destroy', ['scraper_keyword' => $id]) }}" class="btn btn-sm btn-danger btn-crud-delete" onclick="crudDelete(this)"><i class="fas fa-trash"></i></a>
