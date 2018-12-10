<div class="container">
    <div class="row">
        <div class="col-lg-12">
        	<h1><a href="{{ route('home') }}"><span class="glyphicon glyphicon-ok"></span> Task PHP №3</a></h1>
        	@if($has_clients && count($has_clients)>0)
			    <h3>Clients and browser</h3>
				<table class="table">
					<thead>
						<tr>
							<th>Browsers</th>
							<th>Clients<br>count</th>
						</tr>
					</thead>
					<tbody>
						@foreach($has_clients as $client)
							<tr>
								<td>{{ $client->browser }}</td>
								<td><strong>{{ $client->client_count }}</strong></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
        </div>
    </div>
</div>



