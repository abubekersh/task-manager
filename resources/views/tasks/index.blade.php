<x-layouts.app>
    <x-slot:title>Task Manager</x-slot>
        <h1 class="text-3xl mt-10 text-center">Task Manager</h1>
        @php
        $bg = [
        'bg-gradient-to-t from-blue-500 to-green-500',
        'bg-gradient-to-t from-red-500 to-yellow-500',
        'bg-gradient-to-t from-purple-500 to-pink-500 ',
        'bg-gradient-to-t from-teal-500 to-blue-500 ',
        'bg-gradient-to-t from-indigo-500 to-blue-500 '
        ];
        @endphp
        <div class="mt-5 mb-5 border-3 px-10 py-5 rounded w-1/2 m-auto border-white">
            <form action="/" method="get">
                <label for="filter">Filter</label> <select class="
                border border-white bg-black p-1 rounded" name="filter" id="filter">
                    <option value="all" {{$filter=="all"?'selected':''}}>All</option>
                    <option value="pending" {{$filter=="pending"?'selected':''}}>Pending</option>
                    <option value="completed" {{$filter=="completed"?'selected':''}}>Completed</option>
                    <option value="due" {{$filter=="due"?'selected':''}}>Due Tasks</option>
                </select>
                <button class="border border-white p-1 rounded text-black bg-white">apply</button>
            </form>
            @foreach ($tasks as $index => $task)
            <div class="mt-4 rounded  p-4 h-24   {{$task->is_completed||$task->due_date <= now()& $task->due_date != null ?'bg-gradient-to-t from-gray-500 to-black-500':$bg[$index % count($bg)]}} flex">
                <div class="grow">
                    <p class="text-xl text-center  font-bold  {{$task->is_completed?'line-through':''}}">{{$task->title}}</p>
                    <p class="text-center p-2 text-xs {{$task->is_completed?'line-through':''}}">{{$task->description}}</p>
                </div>
                <div class="mt-auto flex gap-2">
                    @if ($task->due_date <= now() && $task->due_date != null && !$task->is_completed)
                        <p class=" p-1 text-xs rounded text-red-400">Your task is Due</p>
                        @endif
                        @if ($task->is_completed)
                        <a href="/tasks/{{$task->id}}/delete" class=" bg-white p-1 text-xs rounded text-red-400">Remove</a>
                        @else
                        <a href="/tasks/{{$task->id}}/edit" class=" bg-white p-1 text-xs rounded text-blue-400">Edit</a>
                        <a href="/tasks/{{$task->id}}/complete" class=" bg-white p-1 text-xs rounded text-blue-400">Done</a>
                        @endif
                </div>
            </div>
            @endforeach
            <div class="text-center my-5 border p-1 border-white">
                <a href="/tasks/create" class="flex flex-col font-bold"> <span>+</span>Add New Task</a>
            </div>
            {{$tasks->links()}}
        </div>
        @if (session('success'))
        @php
        $d =session('success');
        @endphp
        <script>
            alert(@json($d))
        </script>
        @endif
</x-layouts.app>