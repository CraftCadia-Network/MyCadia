@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div id="notfound">
				<h1>Player not found.</h1>
				<h2>Click <a href="{{url('/')}}">here</a> to go homepage.</h2>
			</div>
		</div>
	</div>
</div>

@endsection
