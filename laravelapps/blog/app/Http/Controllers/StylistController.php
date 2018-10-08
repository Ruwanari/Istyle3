<?php

namespace App\Http\Controllers;
use App\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

class StylistController extends Controller{

    public function addStylist(Request $request){
        $stylist = new Stylist();
      
        $stylist->FirstName = $request->input('FirstName');
        $stylist->LastName = $request->input('LastName');
        $stylist->Location = $request->input('Location');
        $stylist->RatePerHour = $request->input('RatePerHour');
        $stylist->ContactNumber = $request->input('ContactNumber');
        $stylist->Email = $request->input('Email');
        $stylist->Password=$request->input('Password');
        $stylist->Gender = $request->input('Gender');
        $stylist->ImageUrl = $request->input('ImageUrl');

        $stylist->save();
        return response()->json(['stylist'=>$stylist],200);

    }



    public function getAllStylists()
    {
        $stylists = \App\Stylist::with('skills','jobTypes')->get(); 
        $response = [
            'stylists'=>$stylists
        ];

        return response()->json($response, 200);
    }

    public function getSkills()
    {
        $skills = \App\Skill::all();
        $response = [
            'skills'=>$skills
        ];

        return response()->json($response, 200);
    }

    public function getLocations()
    {
        $locations = \App\Stylist::distinct()->get(['Location']);
        $response = [
            'locations'=>$locations
        ];

        return response()->json($response, 200);
    }

    public function getJobTypes()
    {
        $jobTypes = \App\JobType::all();
        $response = [
            'jobTypes'=>$jobTypes
        ];

        return response()->json($response, 200);
    }

    

    public function searchStylist($firstname, $lastname)
    {
        $stylists = \App\Stylist::with('skills','jobTypes')->where( 'firstName','LIKE','%' . $firstname . '%')
        ->orWhere('lastName','LIKE','%'.$lastname.'%')->get();

        if(count($stylists) > 0) {
            $response = [
                'stylists'=>$stylists 
            ];
            
            return response()->json($response,200);
        } else {
            return response()->json(['messege'=>'No stylist'],404);  
        }
    }

    public function searchStylist2($keyname)
    {
        $stylists = \App\Stylist::with('skills','jobTypes')->where( 'firstName','LIKE','%' . $keyname . '%')
        ->orWhere('lastName','LIKE','%'.$keyname.'%')->get();

        if(count($stylists) > 0) {
            $response = [
                'stylists'=>$stylists 
            ];
            
            return response()->json($response,200);
        } else {
            return response()->json(['messege'=>'No stylist'],404);  
        }
    }

    public function filter(Request $request, Stylist $stylist)

    {
        $stylist =  \App\Stylist::with('skills','jobTypes')->newQuery();
    
        // Search for a user based on their name.
        if ($request->has('Location')) {
            $stylist->where('Location', $request->input('Location'));
        }
    
        // Search for a user based on their company.
        if ($request->has('RatePerHour')) {
            $stylist->where('RatePerHour','<=',$request->input('RatePerHour'));
        }
    
        // Search for a user based on their city.
        if ($request->has('skill')) {
            $stylist->where('skills->Description', $request->input('skill'));


        }
    
        // Continue for all of the filters.
    
        // Get the results and return them.
        return $stylist->get();

 
    
}


                                


                            
                                                            }
                            
                              

        /*$stylist = Stylist::find($id);
        if(!$stylist){
            return response()->json(['messege'=>'No stylist'],404);
        }
        return response()->json(['stylist' =>$stylist],200);

    }*/



/*$stylist = Stylist::where('firstName','LIKE','%'.$firstname.'%')->get();

if(count($stylist)>0){
    return response()->json(['stylist' =>$stylist],200);
}
*/

?>

   
   