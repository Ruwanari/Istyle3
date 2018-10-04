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

        $stylist->save();
        return response()->json(['stylist'=>$stylist],200);

    }

    public function getAllStylists(){
        $stylists = Stylist::all();
        $response = [
            'stylists'=>$stylists
        ];
        return response()->json($response,200);

    }

    public function searchStylist($firstname,$lastname){
        $stylists = Stylist::where('firstName','LIKE','%'.$firstname.'%')
        ->orWhere('lastName','LIKE','%'.$lastname.'%')->get();

            if(count($stylists)>0){
                $response = [
                    'stylists'=>$stylists
                ];
                return response()->json($response,200);
                                    }

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

   
   