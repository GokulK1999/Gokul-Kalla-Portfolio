<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Management Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-gray-800 dark:text-gray-200">
                <p class="text-2xl font-bold mb-4">{{ __("You're logged in and ready to manage your content.") }}</p>
                
                <!-- Buttons -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="menu" class="dashboard-button bg-transparent hover:bg-blue-500 text-blue-500 hover:text-white">
                        View All Products
                    </a>
                    <a href="/receipt" class="dashboard-button bg-transparent hover:bg-green-500 text-green-500 hover:text-white">
                        View Receipt
                    </a>
                    <a href="/invoices" class="dashboard-button bg-transparent hover:bg-red-500 text-red-500 hover:text-white">
                        View Invoice
                    </a>
                    <a href="/feedback/show" class="dashboard-button bg-transparent hover:bg-purple-500 text-purple-500 hover:text-white">
                        View Feedback
                    </a>
                    <a href="/chart" class="dashboard-button bg-transparent hover:bg-indigo-500 text-indigo-500 hover:text-white">
                        Client Registration Report Sales
                    </a>
                    <a href="/piechart" class="dashboard-button bg-transparent hover:bg-indigo-500 text-indigo-500 hover:text-white">
                        Service Rating Report Sales
                    </a>
                    <a href="/line-chart" class="dashboard-button bg-transparent hover:bg-indigo-500 text-indigo-500 hover:text-white">
                        Catering Booking Report Sales
                    </a>
                    <a href="/customers" class="dashboard-button bg-transparent hover:bg-indigo-500 text-indigo-500 hover:text-white">
                        Customer Lists
                    </a>
                    <a href="/managementmenu" class="dashboard-button bg-transparent hover:bg-indigo-500 text-indigo-500 hover:text-white">
                        Food Menu
                    </a>
                    <a href="/catering-booking" class="dashboard-button bg-transparent hover:bg-indigo-500 text-indigo-500 hover:text-white">
                        Manage Catering Booking
                    </a>
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
