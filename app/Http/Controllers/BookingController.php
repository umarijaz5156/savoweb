<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Availability;
use App\Models\Slot;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    //

    public function index(){

        $availabilities = Availability::with('slots')->get();
//        dd($availabilities);
        return view('web.booking',compact('availabilities'));
    }


    public function details(Request $request){
        $slot_id = $request->slot_id;
        return view('web.booking-details',compact('slot_id'));

    }

    public function store(Request $request){
        $request->validate([
            'slot_id' => 'required',
            'client_name' => 'required',
            'client_email' => 'required',
        ]);

        $number = $request->country_code . $request->client_number;
        $appointment = Appointment::create([
           'slot_id' => $request->slot_id,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'guest_email' => $request->guest_emails,
            'client_number' => $number,
        ]);

         Slot::where('id',$request->slot_id)->update([
            'status' => 1
        ]);

        $request->session()->put('appointment', $appointment);

        $client = new Google_Client();

        $client->setClientId(env('GOOGLE_CALENDAR_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CALENDAR_CLIENT_SECRET'));
        $client->setRedirectUri(route('google.calendar.callback'));
        $client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->setAccessType('offline');

        $authUrl = $client->createAuthUrl();
        return Redirect::away($authUrl);

    }


    public function callback(Request $request){



        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CALENDAR_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CALENDAR_CLIENT_SECRET'));
        $client->setRedirectUri(route('google.calendar.callback'));
        $client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->setAccessType('offline');

        if ($request->has('code')) {

            $accessToken = $client->fetchAccessTokenWithAuthCode($request->input('code'));
            $client->setAccessToken($accessToken);
            $request->session()->put('google_access_token', $accessToken);
            return redirect()->route('google.calendar.create-event');

        } else {
            $authUrl = $client->createAuthUrl();
            return redirect()->to($authUrl);
        }

    }

    public function createEvent(Request $request)
    {

        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CALENDAR_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CALENDAR_CLIENT_SECRET'));
        $client->setRedirectUri(route('google.calendar.callback'));
        $client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);
        $client->setAccessType('offline');

        if ($accessToken = $request->session()->get('google_access_token')) {
            $client->setAccessToken($accessToken);

            $service = new Google_Service_Calendar($client);

              $appointment = $request->session()->get('appointment');
              $slot = Slot::where('id',$appointment->slot_id)->first();
              $availabilityy = Availability::where('id',$slot->availability_id)->first();


            $date = $availabilityy->date;
            $start_time = $slot->start_time;
            $end_time = $slot->end_time;


            $datetimeStart = date('Y-m-d\TH:i:s', strtotime($date . ' ' . $start_time));
            $datetimeEnd = date('Y-m-d\TH:i:s', strtotime($date . ' ' . $end_time));

            $event = new Google_Service_Calendar_Event([
                'summary' => env('MEETING_TITLE'),
                'start' => [
                    'dateTime' => $datetimeStart,
                    'timeZone' => env('TIME_ZONE'),
                ],
                'end' => [
                    'dateTime' => $datetimeEnd,
                    'timeZone' => env('TIME_ZONE'),
                ],
                'conferenceData' => [
                    'createRequest' => [
                        'requestId' => $appointment->slot_id,
                    ],
                ],
            ]);

            $event = $service->events->insert('primary', $event, ['conferenceDataVersion' => 1]);

            $meetLink = $event->getConferenceData()->getEntryPoints()[0]->uri;

             Appointment::where('id',$appointment->id)->update([
                'meet_link' => $meetLink
            ]);

            $details = [
                'client_title' => 'You Booked a new appointment.',
                'admin_title' => 'You Received a new appointment.',
                'name' => $appointment->client_name,
                'link' => $meetLink,
                'date' => $date,
                'datetimeStart' => $datetimeStart,
                'datetimeEnd' => $datetimeEnd,
                'start_time' => $start_time,
                'end_time' => $end_time
            ];

//            client email
            \Mail::to($appointment->client_email)->send(new \App\Mail\AppointmentClientMail($details));


//            admin email
            \Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\AppointmentAdminMail($details));

            if (auth::user()){
                Session::forget('google_access_token, appointment');
                return Redirect::route('appointment.index')->with('message', 'Appointment Booked Successfully');
            }

            $slot = Slot::with('appointment')->findOrFail($appointment->slot_id);
            $availability = Availability::where('id',$slot->availability_id)->first();
            return view('web.booking-confirm',compact('slot','availability'));

        } else {
            $authUrl = $client->createAuthUrl();
            return redirect()->to($authUrl);
        }
    }



}
