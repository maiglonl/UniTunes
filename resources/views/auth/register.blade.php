@extends('layouts.app')

@section('appContent')
<div class="container-fluid bg-info dker" style="height: 100%;">
	<section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
		<div class="container aside-xl">
			<a class="navbar-brand block" href="{{ url('/home') }}"><span class="h1 font-bold">{{ config('app.name', 'UniTunes') }}</span></a>
			<section class="m-b-lg">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
					{{ csrf_field() }}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<input id="name" type="text" class="form-control rounded input-lg text-center no-border" placeholder="Nome" name="name" value="{{ old('name') }}" required autofocus>
						@if ($errors->has('name'))
							<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<input id="email" type="email" class="form-control rounded input-lg text-center no-border" placeholder="Email" name="email" value="{{ old('email') }}" required>
						@if ($errors->has('email'))
							<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<input id="password" type="password" class="form-control rounded input-lg text-center no-border" placeholder="Senha" name="password" required>
						@if ($errors->has('password'))
							<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
						@endif
					</div>
					<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
						<input id="password-confirm" type="password" class="form-control rounded input-lg text-center no-border" placeholder="Confirme a senha" name="password_confirmation" required>
						@if ($errors->has('password_confirmation'))
							<span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
						@endif
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign in</span></button>
					</div>
				</form>
			</section>
		</div>
	</section>
</div>
@endsection