@extends('layouts.app')
@section('content')
<div class="row">
	<form method='post' action="/new-post">

		<div class="col-md-4 col-md-offset-3">
			<div class="form-group">
				<label>Title</label>
				<input id="title" class="form-control" required type="text" name="title" value="{{old('title')}}" />
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea id="body" class="form-control" required name="body">{{old('body')}}</textarea>
			</div>

			<input type="hidden" name="_method" value="post">
			<input type="submit" name="publish" value='Publish'/>
			<input type="submit" name="save" value='Save Draft'/>
		</div>
		{{csrf_field()}}
	</form>
</div>
@endsection