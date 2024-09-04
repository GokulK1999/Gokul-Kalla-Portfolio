<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; // Assuming your Review model is in the App\Models namespace

class PieChartController extends Controller
{
    public function pieChart(){
        $ratings = Feedback::selectRaw('star_rating as rating, COUNT(*) as count')
                        ->groupBy('rating')
                        ->orderBy('rating')
                        ->get();

                        // Output detailed information about each rating for debugging
    foreach ($ratings as $rating) {
        echo "Rating: " . $rating->rating . ", Count: " . $rating->count . "<br>";
    }


        $labels=[];
        $data=[];
        $colors = ['#FF5733', '#3498DB', '#2ECC71', '#F1C40F', '#9B59B6']; // Change colors here

        foreach($ratings as $rating) {
            $label = $rating->rating . ' Stars'; // Assuming rating is from 1 to 5
            array_push($labels, $label);
            array_push($data, $rating->count);
        }

        $datasets = [
            [
                'data'=> $data,
                'backgroundColor' => $colors
            ]
        ];

        return view('pieChart', compact('datasets', 'labels'));

    }
}