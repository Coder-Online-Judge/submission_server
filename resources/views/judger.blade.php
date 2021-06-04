<form action="{{route('judger')}}" method="post">
	@csrf
	<input type="text" name="judger_server" placeholder="Enter judger server url"><br/>
	<input type="checkbox" name="is_reset">Is Reset<br/>
	<input type="submit" name="Update Judger">
</form>

<table>
	<tr>
		<th>Server Name</th>
		<th>Created At</th>
	</tr>
	@foreach($judgers as $key => $judger)
	<tr>
		<td>{{$judger->judger_url}}</td>
		<td>{{$judger->created_at}}</td>
	</tr>
	@endforeach
</table>