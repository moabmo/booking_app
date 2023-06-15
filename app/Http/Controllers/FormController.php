<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;


class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // Retrieve the selected date and time
        $selectedDate = $request->input('date');
        $selectedTime = $request->input('time');

        // Save the form data to the database
        $formData = new FormData;
        $formData->date = $selectedDate;
        $formData->time = $selectedTime;
        $formData->save();

        echo '<script>alert("Successfully booked!"); window.location = "/";</script>';

    }


}
