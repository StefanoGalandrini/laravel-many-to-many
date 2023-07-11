@extends('admin.layouts.base')

@section('contents')
	<div class="card mx-auto rounded" style="width: 50vw">
		<div class="card-body">
			<span class="card-title fs-5 fw-bold">TECHNOLOGY: </span><span class="fs-4">{{ $technology->name }}</span>
			<h4>Projects using this Technology:</h4>
			<ul class="list-group list-group-flush">
				@foreach ($technology->projects as $project)
					<li class="list-group-item">
						<a href="{{ route('admin.projects.show', ['project' => $project]) }}">"{{ $project->title }}"</a><span> -
							({{ $project->creation_date }})
						</span>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
@endsection
