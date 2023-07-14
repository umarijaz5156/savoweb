<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Slot;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{


    public function index(){
        $availabilities = Availability::all();
        return view('admin.availability.index',compact('availabilities'));
    }
    public function create(){
        return view('admin.availability.create');
    }

    public function store(Request $request){

         $request->validate([
            'day' => 'required|array',
             'date' => 'required|array',
            'start_time' => 'required|array',
            'end_time' => 'required|array',
            'duration' => 'required|array',
            'duration.*' => 'required|int',
        ]);
        $inputData = $request->only(['day', 'date', 'start_time', 'end_time', 'duration']);

        foreach ($inputData['day'] as $key => $day) {
            $availability = new Availability();
            $availability->day = $day;
            $availability->date = $inputData['date'][$key];
            $availability->start_time = $inputData['start_time'][$key];
            $availability->end_time = $inputData['end_time'][$key];
            $availability->duration = $inputData['duration'][$key];
            $availability->save();

            $slots = $this->createSlots($availability);

            $availability->slots()->saveMany($slots);
        }

        return redirect(route('availability.index'))->with('message','Availability Created Successfully');
    }



    public function edit($id){
        $availability = Availability::findOrfail($id);
        return view('admin.availability.edit',compact('availability'));
    }

    public function update(Request $request){

        $availability = Availability::findOrfail($request->id);
        $availability->update([
            'day' => $request->day,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'duration' => $request->duration,
        ]);
        Slot::where('availability_id', $request->id)->delete();

        $slots = $this->createSlots($availability);
        $availability->slots()->saveMany($slots);

        return back()->with('message','update successfully');

    }

    public function destroy($id){

        $availability = Availability::findOrfail($id);
        $availability->delete();
        Slot::where('availability_id', $id)->delete();
        return back()->with('message','Deleted successfully');


    }

    private function createSlots($availability)
    {
        $slots = [];
        $start = strtotime($availability->start_time);
        $end = strtotime($availability->end_time);
        $duration = $availability->duration * 60;

        while ($start + $duration <= $end) {
            $slot = new Slot();
            $slot->availability_id = $availability->id;
            $slot->start_time = date('H:i:s', $start);
            $slot->end_time = date('H:i:s', $start + $duration);
            $slots[] = $slot;
            $start += $duration;
        }
        return $slots;
    }
}
