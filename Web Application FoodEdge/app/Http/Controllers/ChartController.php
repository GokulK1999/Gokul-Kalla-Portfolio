<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class ChartController extends Controller

{
    public function userChart()
{
    $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->where('role', 3) // Filter users with role equal to 3
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
                      // Output detailed information about each user for debugging
                foreach ($users as $user) {
        echo "Month: " . $user->month . ", Count: " . $user->count . "<br>";
    }


    $labels = [];
    $data = [];
    $colors = [];

    $maxCount = 0;
    foreach ($users as $user) {
        if ($user->count > $maxCount) {
            $maxCount = $user->count;
        }
    }

    for ($i = 1; $i <= 12; $i++) {
        $month = date('F', mktime(0, 0, 0, $i, 1));
        $count = 0;

        foreach ($users as $user) {
            if ($user->month == $i) {
                $count = $user->count;
                break;
            }
        }

        array_push($labels, $month);
        array_push($data, $count);

        // Determine the color for each bar
        if ($count == $maxCount) {
            array_push($colors, 'black'); // Highlight the highest bar with yellow color
        } else {
            array_push($colors, 'black');
        }
    }

    $datasets = [
        [
            'label' => 'Users',
            'data' => $data,
            'backgroundColor' => $colors
        ]
    ];

    return view('clientChart', compact('datasets', 'labels'));
}
}