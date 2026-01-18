<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen py-8 px-4 transition-colors duration-300 relative">
    <!-- Bubble Container -->
    <div class="bubble-container"></div>

    <div class="max-w-2xl mx-auto relative z-10">
        <!-- Header Section -->
        <div class="mb-8">
            <a 
                href="/" 
                class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-medium mb-4 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to list
            </a>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-2">Edit Task</h1>
            <p class="text-gray-600 dark:text-gray-400">Update your task details</p>
        </div>

        <!-- Edit Task Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="POST" action="/todo/{{ $todo->id }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Task Input -->
                <div>
                    <label for="task" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Task Description
                    </label>
                    <input 
                        type="text" 
                        id="task"
                        name="task" 
                        value="{{ $todo->task }}" 
                        placeholder="Enter task description" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                    >
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 pt-2">
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-indigo-600 dark:bg-indigo-500 text-white font-medium rounded-md hover:bg-indigo-700 dark:hover:bg-indigo-600 active:bg-indigo-800 dark:active:bg-indigo-700 transition-colors duration-200"
                    >
                        Update Task
                    </button>
                    <a 
                        href="/"
                        class="flex-1 px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-md hover:bg-gray-200 dark:hover:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-500 transition-colors duration-200 text-center"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
            <p class="text-sm text-blue-800 dark:text-blue-300">
                <span class="font-semibold">Tip:</span> Make your task descriptions clear and actionable for better productivity.
            </p>
        </div>
    </div>
</body>
</html>