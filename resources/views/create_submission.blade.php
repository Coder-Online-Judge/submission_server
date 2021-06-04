<style type="text/css">
	input{
		margin-bottom: 5px;
		padding: 5px;
	}
	textarea{
		margin-bottom: 5px;
	}
</style>

<form method="post" action="{{url('api/submissions')}}">
	@csrf
	language_id<br/>
	<input type="text" name="language_argument" value="cpp"><br/>
	time_limit<br/>
	<input type="" name="time_limit"><br/>
	memory_limit<br/>
	<input type="" name="memory_limit"><br/>
	input<br/>
	<textarea rows="7" cols="20" name='input'></textarea><br/>
	output<br/>
	<textarea rows="7" cols="20" name='expected_output'></textarea><br/>
	source_code<br/>
	<textarea rows="15" cols="70" name='source_code'></textarea><br/>
	<input type="radio" name="checker_type" value="custom">Custom Checker
	<input type="radio" name="checker_type" value="default">Default Checker<br>
	<textarea name="default_checker" placeholder="default checker"></textarea>
	<textarea name="custom_checker" placeholder="custom checker"></textarea></br/>

	<button type="submit">Submit</button>
</form>

