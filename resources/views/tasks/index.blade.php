<x-app-layout>
    <x-slot name="header">
        {{ __('Tasks') }}
    </x-slot>

    <div class="mb-4 flex justify-between">
        <a class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600 keychainify-checked" href="{{ route('tasks.create') }}">
            Create
        </a>
    </div>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <!-- <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
            <div class="flex justify-center items-center w-12 bg-blue-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-blue-500">Info</span>
                    <p class="text-sm text-gray-600">Sample table page</p>
                </div>
            </div>
        </div> -->
        
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Project</th>
                        <th class="px-4 py-3">Assigned team</th>
                        <th class="px-4 py-3">Assigned user</th>
                        <th class="px-4 py-3">Deadline</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                    @foreach($tasks as $task)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('tasks.show', $task) }}" class="text-blue-500 no-underline hover:underline">
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->project->title }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->team->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->user->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->deadline }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $task->status }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600 keychainify-checked" href="{{ route('tasks.edit', $task->id) }}">Edit</a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600 keychainify-checked">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $tasks->links() }}
            </div>
        </div>

    </div>
</x-app-layout>