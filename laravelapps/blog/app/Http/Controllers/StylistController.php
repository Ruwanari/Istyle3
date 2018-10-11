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

    public function getRates()
    {
        $rates = \App\Stylist::distinct()->get(['RatePerHour']);
        $response = [
            'rates'=>$rates
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
        $stylist =  \App\Stylist::
        join('stylistskill', 'stylists.id', '=', 'stylistskill.stylist_id')
        ->join('skill', 'stylistskill.skill_id', '=', 'skill.id')
        ->join('stylistjobtype','stylists.id','=', 'stylistjobtype.stylist_id')
        ->join('jobtype','stylistjobtype.job_type_id', '=', 'jobtype.id')
        ->select('stylists.*', 'skill.Description','jobtype.JobDescription')
        ->groupBy('stylists.id')
        ->newQuery();

    
        if ($request->has('location')) 
        {
            $stylist->where('Location', $request->input('location'));
        }
    
        // Search for a user based on their company.
        if ($request->has('rate')) 
        {
            $stylist->where('RatePerHour','<=',$request->input('rate'));
        }
    
        // Search for a user based on their city.
        if ($request->has('skill')) 
        {
            $stylist->where('Description',$request->input('skill'));
        }

        if ($request->has('jobType')) 
        {
            $stylist->where('JobDescription',$request->input('jobType'));
            
        }
        

        // Search for a user based on their name.
        

        // Get the results and return them.
        return $stylist->get();
    
}


public function viewProfile($id)
{
    $stylist = \App\Stylist::with('skills','jobTypes')->find($id); 
    $response = [
        'stylist'=>$stylist
    ];

    return response()->json($response, 200);
}

public function viewGallery($id)
{
    $gallery = \App\Gallery::where('StylistId', $id)->select('ImageUrl')->get();
    $response = [
        'gallery'=>$gallery
    ];

    return response()->json($response, 200);
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

   
   