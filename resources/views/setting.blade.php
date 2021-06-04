<form action="{{route('setting')}}" method="post">
	@csrf
	Judger Process : <input type="number" name="judger_process" value="{{$setting->judger_process}}" placeholder="Enter judger server url"><br/>
	<input type="submit" name="Update Setting">
</form> 