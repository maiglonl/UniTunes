@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable padder" id="bjax-target">
			<!-- Discover -->
			<div class="row">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">Upload New Media</header>
					@if(Session::has('success'))
						{{ Session::get("Success") }}
					@endif
					@if($errors->any())
						@foreach($errors->all() as $error)
							{{ $error }}<br>
						@endforeach
					@endif
					<div class="panel-body">
						<form class="form-horizontal" method="post" action=" @yield("newAction") " enctype="multipart/form-data" data-validate="parsley">
							{{ csrf_field() }}
							<div class="form-group">
								<label class="col-sm-2 control-label">Nome</label>
								<div class="col-sm-9">
									<input type="text"  class="form-control" name="name" data-required="true">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Descrição</label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="6" data-minwords="2" data-required="true" name="description"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Autores</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="authors" data-required="true">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Categoria</label>
								<div class="col-sm-4">
									<select data-required="true" class="form-control" name="idCategory">
										<option disabled selected value></option>
										@foreach($categs as $categ)
											<option value="{{ $categ->id }}">{{ $categ->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Preço</label>
								<div class="col-sm-4">
									<input type="number" step="0.10" data-min="0" data-max="999" class="form-control" name="price" data-required="true">
								</div>
							</div>

							@yield('newForm')

							<div class="form-group">
								<label class="col-sm-2 control-label">Imagem</label>
								<div class="col-sm-6">
									<input accept="image/*" type="file" class="filestyle" name="image" data-icon="true" data-classButton="btn btn-default" data-classInput="form-control inline v-middle input-s-lg" data-required="true">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<button type="submit" class="btn btn-default">Cancel</button>
									<button type="submit" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
			<!-- /Discover -->
		</section>
	</section>
@endsection

@section('appFooter')
	<script src="{{ URL::asset('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ URL::asset('js/parsley/parsley.min.js') }}"></script>
	<script src="{{ URL::asset('js/parsley/parsley.extend.js') }}"></script>
@endsection
