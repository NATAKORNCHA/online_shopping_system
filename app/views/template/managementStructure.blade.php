@extends('template.structure')
@section('content')
{{-- product management sidebar --}}
	<div class = "col-md-4 well">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Options</h3>
		  </div>
		  <div class="panel-body">
		    <ul class="nav nav-pills nav-stacked" >
				<li ><a href = "{{ URL::to('product'); }}" >Product Management</a></li>
				<li ><a href = "{{ URL::to('order'); }}">Order Management</a></li>
				<li ><a href = "{{ URL::to('message'); }}">Inbox Management</a></li>
				<li ><a href = "{{ URL::to('user'); }}">User Management</a></li>
				<li ><a href = "{{ URL::to('logout'); }}" >Logout</a></li>
			</ul>
		  </div>
		</div>
	</div>
	<div class = "col-md-8 well">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">Management</h3>
		  </div>
		  <div class="panel-body">
		  	@yield('productContent')
		  </div>
		</div>
	</div>
@stop