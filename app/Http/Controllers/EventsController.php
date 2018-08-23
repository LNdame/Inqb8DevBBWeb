<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Auth;
use App\Establishment;
use DB;
use Yajra\Datatables\Datatables;
use Image;
use File;

class EventsController extends Controller
{
    public function getEstEvents()
    {
        return view('events.establishment_events');
    }

    public function getEstablishmentEvents()
    {

        $events = DB::table('events')
            ->select('title', 'events.id', 'events.start_date', 'events.end_date', 'events.status', 'events.description', 'events.address');

        return DataTables::of($events)
            ->addColumn('action', function ($event) {
                return '<a href="view_establishment_events/' . $event->id . '" style="margin-top:1em;"
            title="View Event" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i>
            </a><a href="edit_establishment_event/' . $event->id . '" style="margin-left:0.5em;margin-top: 1em;" title="Edit Promo" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_establishment_event/' . $event->id . '"  style="margin-left:0.5em;margin-top: 1em;" class="btn btn-xs btn-danger" title="Edit Event"><i class="glyphicon glyphicon-trash "></i></a>';
            })->make(true);
    }

    public function createEstablishmentEvent()
    {
        $user = Auth::user();
        $establishments = Establishment::all();
        return view('events.create_establishment_event', compact('establishments'));
    }

    public function saveEstablishmentEventApi(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $main_picture_url = $request->file('main_picture_url');
//            $picture_2 = $request->file('picture_2');
//            $picture_3 = $request->file('picture_3');
            $dir = "photos/";

            $img = null;
            $img_2 = null;
            $img_3 = null;

            $path = null;
            $path_2 = null;
            $path_3 = null;

            if (File::exists(public_path($dir)) == false) {
                File::makeDirectory(public_path($dir), 0777, true);
            }
            $img = Image::make($main_picture_url->path());
//            $img_2 = Image::make($picture_2->path());
//            $img_3 = Image::make($picture_3->path());

            $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
//            $path_2 = "{$dir}" . uniqid() . "." . $picture_2->getClientOriginalExtension();
//            $path_3 = "{$dir}" . uniqid() . "." . $picture_3->getClientOriginalExtension();
            $img->save(public_path($path));
//            $img_2->save(public_path($path_2));
//            $img_3->save(public_path($path_3));

            $input['main_picture_url'] = $path;
            $input['picture_2'] = $path_2;
            $input['picture_3'] = $path_3;

            $event = Event::create($input);
            DB::commit();
            return response()->json(["message"=>"event created successfully","status"=>200,"event"=>$event]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>"event can not be created successfully","status"=>500,"event"=>$event]);
        }
//        return redirect('get_establishment_events');
    }

    public function saveEstablishmentEvent(Request $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $main_picture_url = $request->file('main_picture_url');
            $picture_2 = $request->file('picture_2');
            $picture_3 = $request->file('picture_3');
            $dir = "photos/";

            $img = null;
            $img_2 = null;
            $img_3 = null;

            $path = null;
            $path_2 = null;
            $path_3 = null;

            if (File::exists(public_path($dir)) == false) {
                File::makeDirectory(public_path($dir), 0777, true);
            }
            $img = Image::make($main_picture_url->path());
            $img_2 = Image::make($picture_2->path());
            $img_3 = Image::make($picture_3->path());

            $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
            $path_2 = "{$dir}" . uniqid() . "." . $picture_2->getClientOriginalExtension();
            $path_3 = "{$dir}" . uniqid() . "." . $picture_3->getClientOriginalExtension();
            $img->save(public_path($path));
            $img_2->save(public_path($path_2));
            $img_3->save(public_path($path_3));

            $input['main_picture_url'] = $path;
            $input['picture_2'] = $path_2;
            $input['picture_3'] = $path_3;

            $event = Event::create($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('get_establishment_events');
    }

    public function editEstablishmentEvent(Event $event)
    {
        $establishments = Establishment::all();
        return view('events.edit_establishment_event', compact('event', 'establishments'));
    }

    public function viewEstablishmentEvent(Event $event)
    {
        $establishments = Establishment::all();
        return view('events.view_establishment_event', compact('event', 'establishments'));
    }

    public function deleteEstablishmentEvent(Event $event)
    {
        $event->delete();
        return redirect('get_establishment_events');

    }
    public function updateEstablishmentEventApi(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $path = null;
            $main_picture_url = $request->file('main_picture_url');
            $dir = "photos/";

            if ($main_picture_url != null) {
                $img = Image::make($main_picture_url->path());
                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
                $img->save(public_path($path));
            } else {
                $path = $event->main_picture_url;
            }

            $input['main_picture_url'] = $path;
            $event = $event->update($input);
            DB::commit();
            return response()->json(["message"=>"event updated successfully","status"=>200,"event"=>$event]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["message"=>"error updating event".$e->getMessage(),"status"=>500,"event"=>$event]);
        }
//        return redirect('get_establishment_events');
    }
    public function updateEstablishmentEvent(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $path = null;
            $main_picture_url = $request->file('main_picture_url');
            $dir = "photos/";

            if ($main_picture_url != null) {
                $img = Image::make($main_picture_url->path());
                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
                $img->save(public_path($path));
            } else {
                $path = $event->main_picture_url;
            }

            $input['main_picture_url'] = $path;
            $event = $event->update($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('get_establishment_events');
    }
    public function getEstablishmentEventsApi($id)
    {
        $events = Event::where('creator_id',$id)->get();
        return $events;
    }

    public function getEventsApi()
    {
        $events = Event::where('status', 'active')->get();
        return $events;
    }

    public function getEventApi($event)
    {
        $event = Event::where('id', $event)->get();
        if ($event != null) {
            return $event;
        }
        return [];

    }

}
