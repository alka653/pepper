{{ Form::open(['url' => $url, 'method' => 'get', 'class' => 'row']) }}
	<div class="col-11">
		{{ Form::text('query', $query, ['placeholder' => $placeholder, 'class' => 'form-control']) }}
	</div>
	<div class="col-1">
		{!! Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-default']) !!}
	</div>
	@if(isset($extra))
		@include($extra)
	@endif
{{ Form::close() }}