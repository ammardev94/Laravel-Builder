@if ($errors->any())
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<p><i class="icon fa fa-ban"></i>&nbsp;No of errors: ({{ count($errors->all()) }})</p>
		<div>
			<ol>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ol>
		</div>
	</div>
@endif

@if (Session::has('msg.error'))
<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h5><i class="icon fas fa-ban"></i> Alert!</h5>
	{{ Session::get('msg.error') }}
</div>
@endif

@if (Session::has('msg.success'))
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<h5><i class="icon fas fa-check"></i> Alert!</h5>
	{{ Session::get('msg.success') }}
</div>
@endif