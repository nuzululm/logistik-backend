<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Fleet;

class FleetsController extends Controller
{
    public function index(Request $request)
    {
        $fleets = Fleet::when($request->q, function($fleets) use($request){
            $fleets->where('plate_number', $request->plate_number);
        })->orderBy('created_at', 'DESC')->paginate(10);
        return response()->json(['status' => 'success', 'data' => $fleets]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'plate_number' => 'required|string|unique:fleets,plate_number',
            'type' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $user = $request->user();
        $file = $request->file('photo');
        $filename = $request->plate_number.'-'.time().'.'. $file->getClientOriginalExtension();
        $file->move(base_path('public/armada'), $filename); 

        Fleet::create([
            'plate_number' => $request->plate_number,
            'type' => $request->type,
            'photo' => $filename,
            'user_id' => $user->id
        ]);

        return response()->json(['status' => 'success']);
    }

    public function edit($id)
    {
        $fleet = Fleet::find($id);

        return response()->json(['status' => 'success', 'data' => $fleet]);
    }
}
