@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between w-full items-end">
            <p class="text-gray-400 no-underline text-sm font-normal">
                <a href="{{ route('projects.index') }}" class="text-gray-400 no-underline text-sm font-normal">My
                    Projects</a>
                / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}" alt="{{ $member->name }}'s
                    avatar" class="rounded-full w-8 mr-2">
                @endforeach
                <img src="{{ gravatar_url($project->owner->email) }}" alt="{{
                    $project->owner->name }}'s
                    avatar" class="rounded-full w-8 mr-2">

                <a href="{{ route('projects.edit', $project) }}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3 mb-6">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="text-gray-400 no-underline font-normal text-lg mb-3">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ $task->path() }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input value="{{ $task->body }}" name="body" class="w-full {{
                                    $task->completed ? 'text-gray-400' : ''
                                     }}">
                                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{
                                    $task->completed ? 'checked' : ''
                                     }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form method="POST" action="{{ $project->path() . '/tasks' }}">
                            {{ csrf_field() }}
                            <input
                                placeholder="Add a new task" type="text" class="w-full" name="body">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-gray-400 no-underline font-normal text-lg mb-3">General Notes</h2>
                    <form method="POST" action="{{ $project->path() }}">
                        @csrf
                        @method('PATCH')
                        <textarea class="card w-full mb-4" name="notes" placeholder="Some special notes for your
                        awesome project.">{{ $project->notes }}</textarea>
                        <button type="submit" class="button">Save</button>
                    </form>

                    @include('errors')

                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')

                @include('projects.activity.card')

                {{--                @if(auth()->user()->is($project->owner))--}}
                @can('manage', $project)
                    @include('projects.invite')
                @endcan
                {{--                @endif--}}

            </div>
        </div>
    </main>
@endsection
