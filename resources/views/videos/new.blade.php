@extends('layouts.new')

@section('newAction') {{ route("musics.new") }} @endsection

@section('newForm')
	<div class="form-group">
		<label class="col-sm-2 control-label">Midia</label>
		<div class="col-sm-6">
			<input type="file" accept=".m4v" class="filestyle" name="media" data-icon="true" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s-lg" data-required="true">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Duração</label>
		<div class="col-sm-4">
			<input type="time" class="form-control" name="duration" data-required="true">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10">
			<input type="text" class="form-control hidden" name="typeMedia" value="2" readonly>
		</div>
	</div>
@endsection
