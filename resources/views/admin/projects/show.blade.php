@extends('admin.layouts.base')

@section('contents')
	@if (session('update_success'))
		@php $project = session('update_success') @endphp
		<div class="alert alert-success">
			Project "{{ $project->title }}" has been successfully updated
		</div>
	@endif
	<div class="card mx-auto rounded">
		<div class="row no-gutters">
			<div class="col-12 col-md-4">
				<img src="{{ $project->url_image }}" alt="{{ $project->title }}" class="card-img img-fluid"
					style="max-width: 90%; height: auto;">
			</div>
			<div class="col-12 col-md-8">
				<div class="card-body">
					<h2 class="card-title">PROJECT:</h2>
					<h3>{{ $project->title }}</h3>
					<h4>- Type: {{ $project->type->name }}</h4>
					<p class="card-text mt-5">Description:</p>
					<p>{{ $project->description }}</p>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<p>Created on: {{ \Carbon\Carbon::parse($project->creation_date)->format('d M Y') }}</p>
					</li>
					<li class="list-group-item">
						<p>URL Github</p>
						<a href="">{{ $project->url_repo }}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
@endsection
