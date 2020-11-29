@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	<form action="{{route('tasks.store')}}" method="POST">
                {{csrf_field()}}
                <label>Add task</label>
                <input type="text" name="task" class="form-control">
                <input type="submit" name="Save" class="btn btn-success">
            </form>
        </div>
    </div>
</div>
@endsection