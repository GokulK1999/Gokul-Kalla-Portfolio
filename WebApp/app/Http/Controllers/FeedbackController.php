<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; 

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable',
            'feedback' => 'required',
            'rating' => 'required|integer|min:1|max:5', // Add validation for rating
        ]);

        // Save feedback data
        $feedback = new Feedback();
        $feedback->name = $validatedData['name'];
        $feedback->feedback = $validatedData['feedback'];
        $feedback->star_rating = $validatedData['rating']; // Assign star rating
        $feedback->save();

        // Flash a success message specifically for feedback form page
        $request->session()->flash('form_success', 'Thank you for your feedback!');

        // Redirect back to the feedback form page
        return back();
    }
    


    public function show()
    {
        // Retrieve feedback data from database
        $feedbacks = Feedback::latest()->get(); //retrieval logic

        return view('feedback_show', compact('feedbacks')); // Pass data to view
    }

    public function showFeedbackForm()
    {
        return view('feedback_form');
    }
}
