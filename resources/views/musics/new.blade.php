@extends('layouts.new')

@section('newAction') {{ route("musics.new") }} @endsection

@section('newForm')
	<div class="form-group">
		<label class="col-sm-2 control-label">Duração</label>
		<div class="col-sm-4">
			<input type="time" class="form-control" name="duration" data-required="true">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10">
			<input type="text" class="form-control hidden" name="typeMedia" value="1" readonly>
		</div>
	</div>
@endsection
