<?php

namespace App\Http\Controllers;

use App\Models\Room_GenderModel;
use App\Models\ObshagaModel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
   public function index(Request $request)
    {
        // Retrieve all rooms from the database
        $query = Room_GenderModel::query();

        // Apply all selected filters
        $query->when($request->filled('filterGender'), function ($q) use ($request) {
            $q->where('roomGender', $request->input('filterGender'));
        });

        $query->when($request->filled('filterObshaga'), function ($q) use ($request) {
            $q->where('obshaga_id', $request->input('filterObshaga'));
        });

        $query->when($request->filled('filterStatus'), function ($q) use ($request) {
            $q->whereHas('room_status', function ($innerQ) use ($request) {
                $innerQ->where('status_rooms', $request->input('filterStatus'));
            });
        });

        // Get the filtered rooms
        $rooms = $query->get();

        // Retrieve all Obshagas for the dropdown
        $obshagas = ObshagaModel::all();

        // Return the view with the rooms and Obshagas data
        return view('commandant.rooms', compact('rooms', 'obshagas'));
    }
}
