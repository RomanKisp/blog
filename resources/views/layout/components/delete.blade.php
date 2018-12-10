<form action="{{ $path }}" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
</form>
