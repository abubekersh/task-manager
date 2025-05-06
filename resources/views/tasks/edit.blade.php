<x-layouts.app>
    <x-slot:title>Edit Task {{$task->title}}</x-slot>
        <h1 class="text-3xl mt-10 text-center">Edit Task {{$task->title}}</h1>

        <div class="mt-5 mb-5 border-3 px-10 py-5 rounded w-1/2 m-auto border-white">
            <form action="/tasks/update" method="post">
                @csrf
                <a href="/" class="font-bold p-2 ml-auto border border-white w-fit block rounded">Back</a>
                <input type="hidden" value="{{$task->id}}" name="id">
                <div class="mb-3"><label for="title">Title</label><br> <input class="bg-white text-black mt-1 w-full border border-white rounded p-2" type="text" value="{{$task->title}}" name="title" id="title">
                    @error('title')
                    <p class="mt-1 text-xs text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div><label for="description">Description</label><br><textarea rows="5" class="bg-white text-black mt-1 w-full border border-white rounded p-2" name="description" id="description">{{$task->description}}</textarea>
                    @error('description')
                    <p class="text-xs text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <div><label for="date">Due Date</label><br><input class="mt-1 w-full border border-white rounded p-2 bg-white text-black" value="{{$task->due_date}}" type="date" name="due_date" min="{{Str::of(now())->explode(' ')[0]}}" id="date">
                    @error('due_date')
                    <p class="text-xs text-red-500">{{$message}}</p>
                    @enderror
                </div>
                <button class="p-2 bg-white text-black rounded w-full mt-5">Update</button>
                <a href="/tasks/{{$task->id}}/delete" class="block text-center p-2 bg-red-500 text-white rounded w-full mt-5">Delete</a>
            </form>
        </div>
</x-layouts.app>