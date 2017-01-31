@extends('layouts.app')
@section('title')
Edit post
@endsection
@section('content')
<div class="row">
	<form method='post' action="{{url('/update')}}">

		<div class="col-md-4 col-md-offset-3">
			<div class="form-group">
				<label>Title</label>
				<input id="title" class="form-control" required type="text" name="title" value="@if(!old('title')){{$post->title}}@endif{{old('title')}}" />
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea id="body" class="form-control" required name="body">@if(!old('body')){!!$post->body!!}@endif{!!old('body')!!}</textarea>
			</div>
			<input type="hidden" name="_method" value="post">
			@if($post->active==1)
			<input class="btn btn-success" type="submit" name="publish" value='Update'/>
			@else
			<input class="btn btn-success" type="submit" name="publish" value='Publish'/>
			@endif
			<input class="btn btn-success" type="submit" name="save" value='Save Draft'/>
           <a class="btn btn-success" href="{{url('delete/'.$post->id.'?_token='.csrf_token())}}">Delete</a>
		</div>
		{{csrf_field()}}
		<input type="hidden" name="post_id" value="@if(!old('post_id')){{$post->id}}@endif{{old('post_id')}}  />
	</form>
</div>
@endsection