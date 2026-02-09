<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8 px-4 transition-colors duration-300 relative">
    <!-- Bubble Container -->
    <div class="bubble-container"></div>

    <div class="max-w-2xl mx-auto relative z-10">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-2">Kajal Todos😎</h1><br>
            <p class="text-gray-600 dark:text-gray-400">This is where I organise my tasks efficiently</p>
        </div>

        <!-- Add Task Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <form method="POST" action="/todo" class="flex gap-3">
                @csrf
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="task" 
                        placeholder="What needs to be done?" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                    >
                </div>
                <button 
                    type="submit"
                    class="px-6 py-3 bg-indigo-600 dark:bg-indigo-500 text-white font-medium rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 active:bg-indigo-800 dark:active:bg-indigo-700 transition-colors duration-200 shrink-0"
                >
                    Add Task
                </button>
            </form>
        </div>

        <!-- Todo List Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            @if($todos->isEmpty())
                <!-- Empty State -->
                <div class="p-12 text-center">
                    <div class="text-5xl mb-4">📝</div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">No tasks yet</h3>
                    <p class="text-gray-600 dark:text-gray-400">Add your first task above to get started</p>
                </div>
            @else
                <!-- Todo Items List -->
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($todos as $todo)
                        <li class="group hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                            <div class="flex items-center gap-4 p-4">
                                <!-- Checkbox -->
                                <form method="POST" action="/todo/{{ $todo->id }}/toggle" class="shrink-0">
                                    @csrf
                                    @method('PATCH')
                                    <input 
                                        type="checkbox" 
                                        {{ $todo->completed ? 'checked' : '' }}
                                        onchange="this.form.submit()"
                                        class="checkbox-custom checkbox-custom-dark checkbox-checked hover:border-indigo-500 dark:hover:border-indigo-400"
                                    >
                                </form>

                                <!-- Task Text -->
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium truncate {{ $todo->completed ? 'line-through text-gray-500 dark:text-gray-500' : 'text-gray-900 dark:text-gray-100' }} transition-all">
                                        {{ $todo->task }}
                                    </p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2 shrink-0">
                                    <!-- Edit Button -->
                                    <a 
                                        href="/todo/{{ $todo->id }}/edit"
                                        class="inline-flex items-center justify-center w-9 h-9 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-md transition-all duration-150"
                                        title="Edit task"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button -->
                                    <form method="POST" action="/todo/{{ $todo->id }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit"
                                            class="inline-flex items-center justify-center w-9 h-9 text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-md transition-all duration-150"
                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                            title="Delete task"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Task Count Footer -->
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-medium text-gray-900 dark:text-gray-100">{{ $todos->count() }}</span> 
                        {{ $todos->count() === 1 ? 'task' : 'tasks' }} total
                        @if($todos->where('completed', true)->count() > 0)
                            • <span class="font-medium text-gray-900 dark:text-gray-100">{{ $todos->where('completed', true)->count() }}</span> completed
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>