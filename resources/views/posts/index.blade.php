@extends('Centaur::layout')

@section('title', 'Posts')

@section('content')
<div class="page-header">
	<div class="btn-toolbar pull-right">
		<a class="btn btn-primary btn-lg" href="{{route('posts.create')}}">
			<span class="glyphicon glyphicon-plus"></span>
				Create New Post		
		</a>
	</div>
	<h1>Posts</h1>

</div>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="table-responsive">
		@if(count($posts)>0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>User</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
						<tr>
							<td>{{$post->title}}</td>
							<td>{{$post->user->email}}</td>
							<td>{{\Carbon\Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans()}}</td>
							<td>
							@if($post->updated_at !== null)
				              {{\Carbon\Carbon::createFromTimestamp(strtotime($post->updated_at))->diffForHumans()}}
							@else
								{{ 'Never' }}
							@endif
							</td>
							<td>
								<a href="{{route('posts.edit', $post->id)}}" class="btn btn-default btn-sm">Edit</a>
								<a href="{{route('posts.destroy', $post->id)}}" class="btn btn-danger btn-sm action_confirm" data-method="delete" data-token="{{csrf_token()}}">Delete</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			{{ 'No posts!' }}
		@endif
	</div>
  </div>
   
</div>
@stop