<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response; // Make sure to import the Response model
use Illuminate\Support\Facades\Auth; // Import Au
class UserResponseController extends Controller
{
      public function responses()
    {
        // Fetch responses of the authenticated user with their associated survey data
        $responses = Response::with('survey') // Assuming you have a relationship with the survey model
                             ->where('user_id', Auth::id()) // Get responses for the logged-in user
                             ->latest() // Order them by the latest
                             ->get();

        // Return the view with the responses
        return view('user.responses.index', compact('responses'));
    }
}
