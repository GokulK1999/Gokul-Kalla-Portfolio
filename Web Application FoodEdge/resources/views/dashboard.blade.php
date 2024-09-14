<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hello Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-2xl font-bold mb-4">{{ __("You're logged in!") }}</p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <a href="/feedback/form" class="dashboard-button bg-blue-500 hover:bg-blue-700">
                            Give Feedback
                        </a>
                        <a href="/customer-booking" class="dashboard-button bg-green-500 hover:bg-green-700">
                            Add Catering
                        </a>
                        <a href="/menu" class="dashboard-button bg-green-500 hover:bg-green-700">
                            View Food Menu
                        </a>
                        <a href="/invoices" class="dashboard-button bg-green-500 hover:bg-green-700">
                            View Invoice
                        </a>
                        <a href="/receipt" class="dashboard-button bg-green-500 hover:bg-green-700">
                            View Receipt
                        </a>
                        @if(Auth::check() && Auth::user()->role == 3)
                            @if(Auth::user()->customer)
                                <a class="dashboard-button bg-yellow-500 hover:bg-yellow-700" href="{{ route('customer.show', Auth::user()->customer->id) }}">
                                    View Customer Profile
                                </a>
                            @else
                                <form action="{{ route('customer.create') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="dashboard-button bg-purple-500 hover:bg-purple-700">
                                        Create Customer Profile
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .dashboard-button {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px 20px;
        background-color: transparent;
        color: #4CAF50;
        border: 2px solid #4CAF50;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
        text-decoration: none;
    }

    .dashboard-button:hover {
        background-color: #4CAF50;
        color: white;
    }
</style>
