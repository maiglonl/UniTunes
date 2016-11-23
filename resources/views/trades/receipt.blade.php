@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<header class="header bg-light lter hidden-print">
			<a href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</a>
			<p>Certificado de compra</p>
		</header>
		<section class="scrollable wrapper">
			<i class="icon-earphones fa-3x m-l"></i>
			<div class="row">
				<div class="col-xs-6">
					<h4>uniTunes</h4>
					<p><a href="#">www.unitunes.com</a></p>
				</div>
				<div class="col-xs-6 text-right">
					<p class="h4">#{{ $trade->id }}</p>
					<h5>{{ $trade->created_at }}</h5>           
				</div>
			</div>          
			<div class="well bg-light b m-t">
				<div class="row">
					<div class="col-xs-6">
						<strong>COMPRADOR:</strong>
						<h4>{{ $buyer->name }}</h4>
						<p>Email: {{$buyer->email }}</p>
					</div>
					<div class="col-xs-6">
						<strong>VENDEDOR:</strong>
						<h4>{{ $seller->name }}</h4>
						<p>Email: {{$seller->email }}</p>
					</div>
				</div>
			</div>
			<p class="m-t m-b">Data da compra: <strong>{{ $trade->created_at }}</strong><br>
				Status da compra: <span class="label bg-success">Conclu</span><br>
				Código da compra: <strong>#{{ $trade->id }}</strong>
			</p>
			<div class="line"></div>
			<table class="table">
				<thead>
					<tr>
						<th style="width: 60px"></th>
						<th>DESCRIÇÃO</th>
						<th style="width: 140px"></th>
						<th style="width: 90px">TOTAL</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>{{ $media->authors." - ".$media->name }}</td>
						<td></td>
						<td>R${{ $trade->price }}</td>
					</tr>
					<tr>
						<td colspan="3" class="text-right no-border"><strong>Total</strong></td>
						<td><strong>R${{ $trade->price }}</strong></td>
					</tr>
				</tbody>
			</table>              
		</section>
	</section>
@endsection