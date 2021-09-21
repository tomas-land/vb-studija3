<?php

namespace App\Http\Controllers;

use App\Models\SubService;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
           $visits=Visit::all();
        return view('admin.visits.index',compact('visits'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_services=SubService::all();
        return view('admin.visits.create',compact('sub_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // $this->validate($request, [
        //     'name' => 'required|unique:authors|max:50',
        //     'surname' => 'required|unique:authors|max:50',
            
        // ]);
        $visit = new Visit();
        $visit->fill($request->all());
   
    return ($visit->save() !== 1) ?
    redirect()->route('visits.index')->with('status_success', "Pridėta!") :
    redirect()->route('visits.index')->with('status_error', "Klaida!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        //
    }
    public function action(Request $request)
    {
        dd('ok');
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Visit::create([

    				'name'		=>	$request->name,
    				'service'		=>	$request->service,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		// if($request->type == 'update')
    		// {
    		// 	$event = Event::find($request->id)->update([
    		// 		'title'		=>	$request->title,
    		// 		'start'		=>	$request->start,
    		// 		'end'		=>	$request->end
    		// 	]);

    		// 	return response()->json($event);
    		// }

    		// if($request->type == 'delete')
    		// {
    		// 	$event = Event::find($request->id)->delete();

    		// 	return response()->json($event);
    		// }
    	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        $sub_services=SubService::all();
        return view('admin.visits.edit',compact('sub_services','visit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        $visit->update($request->all());

        return redirect()->route('visits.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()->route('visits.index')
            ->with('success', 'Deleted successfully');
    }
}