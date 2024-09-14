<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingDetails;

class LineChartController extends Controller
{
    public function chart()
    {
        $bookings = BookingDetails::selectRaw('MONTH(BookingDate) AS month, COUNT(*) AS totalBookings')
            ->groupBy('month')
            ->orderByRaw('MONTH(BookingDate)') // Order by month number
            ->pluck('totalBookings', 'month')
            ->toArray();

            


        $months = [];
        $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // Dynamically generate month names based on the data
        foreach (range(1, 12) as $monthNumber) {
            $monthName = $monthNames[$monthNumber - 1];
            $months[] = $monthName;
        }

        // Find the index of the highest booking
        $highestBookingIndex = array_search(max($bookings), $bookings);

        return view('chart', compact('months', 'bookings', 'highestBookingIndex'));
    }
}