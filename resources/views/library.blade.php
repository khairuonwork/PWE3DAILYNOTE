<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link rel="icon" href="/notepad.png" type="image/x-icon">
</head>
<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Images Library') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                    <!-- Form Section -->
                    <form
                        action="{{ isset($libraryItem) ? route('library.update', $libraryItem->images_id) : route('library.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6"
                    >
                        @csrf
                        @if(isset($libraryItem))
                            @method('PUT')
                        @endif

                        <!-- Title -->
                        <div>
                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $libraryItem->title ?? '') }}"
                                class="form-control border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                placeholder="Title" required
                            >
                        </div>

                        <!-- Notes -->
                        <div>
                            <input
                                type="text"
                                name="notes"
                                value="{{ old('notes', $libraryItem->notes ?? '') }}"
                                class="form-control border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                placeholder="Notes" required
                            >
                        </div>

                        <!-- Image -->
                        <div>
                            <input
                                type="file"
                                name="image"
                                class="form-control border-gray-300 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                {{ isset($libraryItem) ? '' : 'required' }}
                            >
                            @if(isset($libraryItem) && $libraryItem->images)
                                <img src="{{ asset('storage/' . $libraryItem->images) }}" alt="Current Image" class="mt-4 h-24 w-auto">
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="sm:col-span-1 flex justify-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                {{ isset($libraryItem) ? 'Update Item' : 'Add Item' }}
                            </button>
                        </div>
                    </form>

                    <!-- Table Section -->
                    <div class="table-responsive mt-4">
                        <table class="table-auto w-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-lg">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                    <th class="px-4 py-2 border">Image</th>
                                    <th class="px-4 py-2 border">Title</th>
                                    <th class="px-4 py-2 border">Notes</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($libraries as $library)
                                    <tr>
                                        <td class="px-4 py-2 border">
                                            @if($library->images)
                                                <img src="{{ asset('storage/' . $library->images) }}" alt="Library Image" class="h-16 w-auto">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border">{{ $library->title }}</td>
                                        <td class="px-4 py-2 border">{{ $library->notes }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            <!-- Edit Button -->
                                            <a href="{{ route('library.edit', $library->images_id) }}" class="text-blue-500 hover:text-blue-700">
                                                Edit
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('library.destroy', $library->images_id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                            No items found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
