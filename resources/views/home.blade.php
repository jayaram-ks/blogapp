@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$title}}</div>

                <div class="panel-body">
                     <div class="row">
                         @if(!$postz->count())
                        <div class='col-lg-12'> NO POSTS TO SHOW</div>
                         @else

                                @foreach ($postz as $pv)
                                 <div class="col-lg-12"><h3><a href="{{url('/'.$pv->slug)}}">{{$pv->title}}</a></h3></div>
                                 <div class="col-lg-12">{{$pv->body}}</div>
                                     @if(Auth::check())
                                        @if(Auth::user()->role == 'admin' || $pv->author_id == Auth::user()->id )
                                       <div class='col-xs-12'><a class='btn btn-default' href="{{url('edit/'.$pv->slug)}}">Edit Post</a></div>
                                        @endif
                                     @endif
                                @endforeach

                         @endif
                     </div>

                     <div class="row"><div class='col-lg-12'>{{ $postz->links() }}</div></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
