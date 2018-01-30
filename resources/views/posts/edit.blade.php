@extends('Centaur::layout')

@section('title', 'Edit Post')

@push('tinymce')
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endpush
  
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					Edit Post
				</div>
			</div>
		<div class="panel-body">
			<form accept-charset="UTF-8" role="form" method="post" action="{{ route('posts.update', $post->id)}}" >
				<fieldset>
					<div>
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Enter post title" value="{{$post->title}}">
							{!! ($errors->has('title') ? $errors->first('title', '<p class="text-danger">:message</p>') : '') !!}
						</div>
					</div>
					<div class="form-group">
							<textarea class="form-control" name="content" placeholder="Enter post content" style="max-width:100%; height:250px">{!! $post->content !!}</textarea>
							{!! ($errors->has('content') ? $errors->first('content', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					{{ csrf_field() }}
						{{ method_field('PUT') }}
					<input class="btn btn-primary btn-block" type="submit" value="Save">
				</fieldset>
			</form>
		</div>
		</div>
	</div>
</div>
@stop