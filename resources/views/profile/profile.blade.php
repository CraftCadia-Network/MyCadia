@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div id="profilebox">
			<div class="col-sm-3">
				<img src="https://minotar.net/helm/{{$user}}" class="img-responsive">
			</div>
			<div class="col-sm-3">
				<h1>{{$user}}</h1>
				<h2>{{$rank}}
			</div>
		</div>
	</div>
</div>
@if (count($servers) > 0)
	<nav class="navbar navbar-inverse">
	  <div class="container bder">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul id="servers" class="nav navbar-nav">
	        @foreach($servers as $server)
	        	<li><a href="{{$user}}/{{$server->name}}">{{$server->name}}</a></li>
	        @endforeach
	      </ul>
	      
	    </div>
	  </div>
	</nav>
@else
    <div class="container">
    	<p id="nosv">No servers.</p>
    </div>
@endif

@endsection