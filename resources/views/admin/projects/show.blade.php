@extends('admin.layouts.base')

@section('page-title')
	<h1 class="m-0">PROJECT DETAILS</h1>
@endsection

@section('contents')
	@if (session('update_success'))
		@php $project = session('update_success') @endphp
		<div class="alert alert-primary">
			Project "{{ $project->title }}" has been successfully updated
		</div>
	@endif

	@if (session('create_success'))
		@php $project = session('create_success') @endphp
		<div class="alert alert-success">
			Project "{{ $project->title }}" has been successfully created
		</div>
	@endif

	<div class="card mx-auto rounded">
		<div class="row no-gutters">
			<div class="col-12 col-md-4">
				<img src="{{ $project->url_image }}" alt="{{ $project->title }}" class="card-img img-fluid"
					style="max-width: 80%; height: auto;">
			</div>
			<div class="col-12 col-md-8">
				<div class="card-body">
					<div class="row">
						{{-- Loaded image --}}
						@if ($project->image)
							<div class="col-3">
								<img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="img-fluid"
									style="max-width: 80%; height: auto;">
							</div>
						@endif
						<div class="col-{{ $project->image ? '9' : '12' }} border-start ps-3">
							<h2 class="card-title">Project <span class="fst-italic text-uppercase"> "{{ $project->title }}"</span></h2>
							<h4>- Type: {{ $project->type->name }}</h4>
							<h5 class="mt-4 fw-light fst-italic">- Technologies:
								{{ implode(', ', $project->technologies->pluck('name')->all()) }}
							</h5>
							<p class="card-text mt-5">Description:</p>
							<p>{{ $project->description }}</p>
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
			</div>
		</div>
	</div>
@endsection
