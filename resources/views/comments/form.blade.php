<div>
    <div id="error_comment"></div>
    <form id="comment" action="/comment" method="POST">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    	<input type="hidden" name="attachable_id" value="{{ $object->id }}">
    	<input type="hidden" name="attachable_type" value="{{ get_class($object) }}">
        <div class="form-group">
            <label class="control-label">Author</label>
            <input class="form-control" type="text" name="author" style="text-transform: capitalize;">
        </div>
        <div class="form-group">
            <label class="control-label">Comment</label>
            <textarea class="form-control" rows="3" name="comment"></textarea>
        </div>
        <div class="clearfix">
        	<input type="submit" value="Add comment" class="btn btn-primary pull-right">
        </div>
    </form>
</div>
