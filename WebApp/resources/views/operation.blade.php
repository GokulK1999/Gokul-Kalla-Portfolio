<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Operation Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    <div class="mt-4">
                        <a href="/delivery_status" class="dashboard-button bg-blue-500 hover:bg-blue-700">
                            Manage Catering Status
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .dashboard-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: transparent;
        color: #4CAF50;
        border: 2px solid #4CAF50;
        border-radius: 9999px; /* Using a large value to make it round */
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
        text-decoration: none;
    }

    .dashboard-button:hover {
        background-color: #4CAF50;
        color: white;
    }
</style>
