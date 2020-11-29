@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<input type="text" id="search"> <a class="btn btn-warning">Search</a>
        	<table class="table">
        		<tr>
        			<th width="10%"> Completed </th>
        			<th widht="90%"> Task </th>
        		</tr>
        		@forelse($tasks as $task)
        			<tr>
        				<td>
        					<input type="checkbox" class="is_completed" data-id="{{$task->id}}" {{$task->iscompleted ? 'checked' : ''}}>
        				</td>
        				<td>
        					{{$task->task}}
        				</td>
        			</tr>
        		@empty
        			<tr>
        				<td rowspan="2">No current tasks.</td>
        			</tr>
        		@endforelse

        	</table>
        	<br/>
        	<a href="{{route('tasks.add')}}" class="btn btn-default">
        		Add Task
        	</a>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(e) {
		$(".is_completed").click(function (e) {
			$.ajax({
				 url: "task/" + $(this).data('id') + "/change-completed",
				 method: 'get'
			}).done(function() {
				window.location.reload;
			}).fail(function(response) {
				alert('FAILED!');
			});
		});

	});
</script>
@endsection