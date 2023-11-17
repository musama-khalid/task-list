@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    @forelse ($tasks as $task)
        <a href="{{route('tasks.show', ['id' => $task -> id])}}"><h2>{{$task -> title}}</h2></a>
    @empty
    <h2>There are no tasks</h2>
    @endforelse
@endsection




