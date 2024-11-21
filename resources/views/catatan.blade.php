<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notes</title>
    <link rel="icon" href="/notepad.png" type="image/x-icon">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Notes') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    
                    <!-- Form Section -->   
                    <form action="{{ isset($note) ? route('notes.update', $note->id) : route('notes.store') }}" 
                          method="POST" 
                          class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
                        @csrf
                        @if (isset($note))
                            @method('PUT')
                        @endif
                        <div>
                            <input type="text" 
                                   name="title" 
                                   class="form-control border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
                                   placeholder="Title" 
                                   value="{{ $note->title ?? '' }}" 
                                   required>
                        </div>
                        <div>
                            <input type="text" 
                                   name="notes" 
                                   class="form-control border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
                                   placeholder="Notes" 
                                   value="{{ $note->notes ?? '' }}" 
                                   required>
                        </div>
                        <div>
                            <select name="status" 
                                    class="form-control border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" 
                                    required>
                                <option value="">Select Status</option>
                                <option value="Pending" {{ isset($note) && $note->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Progress" {{ isset($note) && $note->status == 'Progress' ? 'selected' : '' }}>Progress</option>
                                <option value="Completed" {{ isset($note) && $note->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="sm:col-span-1 flex justify-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                {{ isset($note) ? 'Update' : 'Add' }}
                            </button>
                        </div>
                    </form>

                    <!-- Table Section -->
                    <div class="table-responsive mt-4">
                        <table class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="px-4 py-2 border">Title</th>
                                    <th class="px-4 py-2 border">Notes</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($notes->isNotEmpty())
                                    @foreach ($notes->sortBy(fn($note) => ['Pending' => 1, 'Progress' => 2, 'Completed' => 3][$note->status]) as $note)
                                        <tr>
                                            <td class="px-4 py-2 border">{{ $note->title }}</td>
                                            <td class="px-4 py-2 border">{{ $note->notes }}</td>
                                            <td class="px-4 py-2 border">{{ $note->status }}</td>
                                            <td class="px-4 py-2 border text-center">
                                                <!-- Edit Button -->
                                                <a href="{{ route('notes.edit', $note->id) }}" class="text-blue-500 hover:text-blue-700">
                                                    Edit
                                                </a>
                                                <!-- Delete Button -->
                                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach 
                                @else
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                            No notes available.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
