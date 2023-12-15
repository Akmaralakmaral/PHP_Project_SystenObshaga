<?php

namespace App\Http\Controllers;
use App\Models\PassModel;
use App\Models\Room_GenderModel;
use Illuminate\Http\Request;

class PassController extends Controller
{
    //  public function index(Request $request, $roomId)
    // {
    //     // Retrieve passes for the specified room
    //     $passes = PassModel::where('room_id', $roomId)->get();

    //     // Retrieve the room data
    //     $room = Room_GenderModel::find($roomId);

    //     // Pass the passes and room data to the view
    //     return view('commandant.passes', compact('passes', 'room'));
    // }


    // public function create($roomId)
    // {
    //     // You can add logic here if needed
    //     return view('commandant.passes_create', compact('roomId'));
    // }

    //  public function store(Request $request, $roomId)
    // {
    //     // Validate the form data
    //     $validatedData = $request->validate([
    //         'student_id' => 'required|numeric', // Add more validation rules as needed
    //         // Add validation rules for other form fields
    //     ]);

    //     // Create a new PassModel instance
    //     $pass = new PassModel([
    //         'student_id' => $validatedData['student_id'],
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //         'room_id' => $roomId,
    //         'employee_id' => null,
    //         // Add more fields as needed
    //     ]);

    //     // Save the pass to the database
    //     $pass->save();

    //     // Redirect to the passes index or another appropriate page
    //     return redirect()->route('commandant.passes', ['room_id' => $roomId]);
    // }

    public function index(Request $request, $roomId)
    {
        // Retrieve passes for the specified room
        $passes = PassModel::where('room_id', $roomId)->get();

        // Retrieve the room data
        $room = Room_GenderModel::find($roomId);

        // Pass the passes and room data to the view
        return view('commandant.passes', compact('passes', 'room'));
    }

    public function create($roomId)
    {
        // You can add logic here if needed
        return view('commandant.passes_create', compact('roomId'));
    }

    public function store(Request $request, $roomId)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'student_id' => 'required|numeric', // Add more validation rules as needed
            // Add validation rules for other form fields
        ]);

        // Create a new PassModel instance
        $pass = new PassModel([
            'student_id' => $request->input('student_id'),
            'start_date' => $request->input('start_date'), // assuming you have 'start_date' and 'end_date' in your form
            'end_date' => $request->input('end_date'),
            'room_id' => $roomId,
            'employee_id' => 1,
            // Add more fields as needed
        ]);

        // Save the pass to the database
        $pass->save();

        // Update room_status based on the number of passes for the room
        $this->updateRoomStatus($roomId);

        // Redirect to the passes index or another appropriate page
        return redirect()->route('commandant.passes', ['room_id' => $roomId]);
    }

    // Helper function to update room_status
    private function updateRoomStatus($roomId)
    {
        $room = Room_GenderModel::find($roomId);

        if (!$room) {
            abort(404);
        }

        // Count the number of passes for the room
        $passesCount = PassModel::where('room_id', $roomId)->count();

        // Update room_status based on passes count
        switch ($passesCount) {
            case 1:
                $room->room_status_id = 5; // 3 beds available
                break;
            case 2:
                $room->room_status_id = 4; // 2 free berths
                break;
            case 3:
                $room->room_status_id = 3; // 1 bed available
                break;
            case 4:
                $room->room_status_id = 1; // Busy
                break;
            // Add more cases as needed

            default:
                // Handle other cases or do nothing
                break;
        }

        // Save the updated room_status to the database
        $room->save();
    }


}
