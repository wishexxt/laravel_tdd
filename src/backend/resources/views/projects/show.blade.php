@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <p class="text-gray-400 no-underline text-sm font-normal">
                <a href="{{ route('projects') }}" class="text-gray-400 no-underline text-sm font-normal">My Projects</a> / {{ $project->title }}
            </p>
            <a href="{{ route('projects.create') }}" class="button">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3 mb-6">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="text-gray-400 no-underline font-normal text-lg mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            {{ $task->body }}
                        </div>
                    @endforeach
                </div>
                <div>
                    <h2 class="text-gray-400 no-underline font-normal text-lg mb-3">General Notes</h2>
                    <textarea class="card w-full">
                        Lorem ipsum.
                    </textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
@endsection