@extends('layouts.app')
@section('content')
<div class="row">
	

		<div class="col-md-4 col-md-offset-3">
			<h2>{{$postz->title}}</h2>
			<div class="col-sm-12">{{$postz->body}}</div>
		</div>
	
</div>
@endsection