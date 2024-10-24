<?php

namespace App\Http\Controllers;
use App\Models\UserInfo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\About;
use App\Models\Overview;
use App\Models\Skill;

class BackendController extends Controller
{
    public function Dashboard(){

        return view('backend.home.index');
    }

   public function addInfo(){

    return view('backend.features.add_info');
   }

   public function showInfo(){
    $user = UserInfo::all();
    
    return view('backend.features.show_info',compact('user'));
   }

   public function insertProfileInfo(Request  $request){
    
    $request->validate([
        'name' => 'required|string|max:255',
        'bannerImage' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'profileImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|',
    ]);
    $bannerImage = null;
        $profileImage = null;

        if ($request->hasFile('bannerImage')) {
            $bannerImage = $request->file('bannerImage')->store('banner_images', 'public');
        }


        if ($request->hasFile('profileImage')) {
            $profileImage = $request->file('profileImage')->store('profile_images', 'public');
        }

        $userinfo = new UserInfo();
        $userinfo->name = $request->name;
        $userinfo->banner_image = $bannerImage;
        $userinfo->profile_image = $profileImage;


        
        // Save the profile data to the database
        $userinfo->save();


        return redirect()->route('dashboard');


   }

   public function editProfileInfo($id){
   

    $userinfo = UserInfo::findOrfail($id);

    
   return view('backend.features.edit_profile_data',compact('userinfo'));


   }

   public function deleteProfileInfo($id){
                  
    UserInfo::where('id',$id);
   }


   public function updateProfileInfo(Request $request)
   {
       $userId = $request->input('userid');
       
       // Fetch the existing user information from the database
       $userInfo = UserInfo::findOrFail($userId);
   
       // Initialize variables to store new image paths
       $bannerImage = $userInfo->banner_image;
       $profileImage = $userInfo->profile_image;
   
       // Handle banner image upload
       if ($request->hasFile('bannerImage')) {
           // Store the new banner image
           $bannerImage = $request->file('bannerImage')->store('banner_images', 'public');
   
           // Unlink (delete) the old banner image if it exists
           if ($userInfo->banner_image) {
               Storage::disk('public')->delete($userInfo->banner_image);
           }
       }
   
       // Handle profile image upload
       if ($request->hasFile('profileImage')) {
           // Store the new profile image
           $profileImage = $request->file('profileImage')->store('profile_images', 'public');
   
           // Unlink (delete) the old profile image if it exists
           if ($userInfo->profile_image) {
               Storage::disk('public')->delete($userInfo->profile_image);
           }
       }
   
       // Update user information with new image paths and other data
       $userInfo->update([
           'name' => $request->input('name'),
           'profile_image' => $profileImage,
           'banner_image' => $bannerImage,
       ]);
   
       return redirect()->route('show.info');

   }
// about section methodes start here
   public function InsertAbout(){
    

    return view('backend.features.insert_about');

   }


   public function insertAboutData(Request $request){

   
        // Validate the incoming request data
        $request->validate([
            'profession' => 'required|string|max:255',
            'birthday' => 'required|date',
            'age' => 'required|integer|min:1',
            'website' => 'nullable|url|max:255',
            'degree' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:abouts,email|max:255',
            'city' => 'required|string|max:255',
            'freelance' => 'required|in:available,not available',
        ]);

        // Create and save the new profile info
        $profileInfo = new About();
        $profileInfo->profession = $request->input('profession');
        $profileInfo->birthday = $request->input('birthday');
        $profileInfo->age = $request->input('age');
        $profileInfo->website = $request->input('website');
        $profileInfo->degree = $request->input('degree');
        $profileInfo->phone = $request->input('phone');
        $profileInfo->email = $request->input('email');
        $profileInfo->city = $request->input('city');
        $profileInfo->freelance = $request->input('freelance');

        $profileInfo->save();

        // Redirect back with a success message
        return redirect()->route('dashboard');
   }

   public function showAbout()
    {
        
        $aboutInfo = About::all();

        
        return view('backend.features.show_about_info', compact('aboutInfo'));
    }

    public function editAboutInfo($id)
{
    // Find the about record by ID
    $aboutInfo = About::findOrFail($id);

    // Pass the record to the edit view
    return view('backend.features.edit_about_info', compact('aboutInfo'));
}

public function updateAboutInfo(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'profession' => 'required|string|max:255',
        'birthday' => 'required|date',
        'age' => 'required|integer|min:1',
        'website' => 'nullable|url|max:255',
        'degree' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255|unique:abouts,email,' . $id, // Ignore unique rule for current record
        'city' => 'required|string|max:255',
        'freelance' => 'required|in:available,not available',
    ]);

    // Find the about record by ID
    $aboutInfo = About::findOrFail($id);

    // Update the record with new data
    $aboutInfo->profession = $request->input('profession');
    $aboutInfo->birthday = $request->input('birthday');
    $aboutInfo->age = $request->input('age');
    $aboutInfo->website = $request->input('website');
    $aboutInfo->degree = $request->input('degree');
    $aboutInfo->phone = $request->input('phone');
    $aboutInfo->email = $request->input('email');
    $aboutInfo->city = $request->input('city');
    $aboutInfo->freelance = $request->input('freelance');

    // Save the updated record
    $aboutInfo->save();

    // Redirect back with a success message
    return redirect()->route('show.about');
}


public function deleteAboutInfo($id){

 About::where('id',$id)->delete();

 return redirect()->route('show.about');
}

// about section methodes end here



// overview section methodes start here


public function InsertOverview(){

    return view('backend.features.insert_overview');
}


public function ShowOverview(){
       
    $overviewdata = Overview::all();
    return view('backend.features.show_overview',compact('overviewdata'));
}



public function InsertOverviewData(Request $request){

    
    // Validate the incoming request data
    $request->validate([
        'emoji' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate emoji as image
        'number' => 'required|integer',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);
   
    // Handle the image file upload
    if ($request->hasFile('emoji')) {
        // Store the image in the 'public' directory
        $imogiPath = $request->file('emoji')->store('imogi_images', 'public');
    } else {
        $imogiPath = null;
    }

    // Create a new Overview record and assign the data
    $overview = new Overview();
    $overview->imogi = $imogiPath; // Store the image path in the database
    $overview->number = $request->input('number');
    $overview->title = $request->input('title');
    $overview->desc = $request->input('description');
     

    // Save the new Overview record in the database
    $overview->save();

    // Redirect back with a success message
    return redirect()->route('show.overview');
}

public function editOverviewInfo($id){


  $data = Overview::findOrfail($id);



    return view('backend.features.edit_overview_data',compact('data'));

}

public function updateOverviewInfo(Request $request,$id){


   
 // Validate the incoming request data




if ($request->hasFile('emoji')) {
    $imogiPath = $request->file('emoji')->store('imogi_images', 'public');
} else {
    $imogiPath = null;
}

// Create a new Overview record and assign the data
Overview::where('id',$id)->update([
         
    'imogi'=> $imogiPath,
    'number' => $request-> number,
    'title' => $request->title,
    'desc' => $request->description,
]);


return redirect()->route('show.overview');

}

public function deleteOverviewInfo($id){

    Overview::where('id',$id)->delete();


    return redirect()->route('show.overview');

}

public function addSkill(){

    return view('backend.features.add_skill');
}

public function insertSkill(Request $request){

  DB::table('skills')->insert([

    'skill_name' => $request->skill_name,
    'skill_capacity' => $request->skill_capacity,


  ]);

  $notification = array(
    'message' => 'Data updated Successfully',
     'alert-type' => 'success');

  return redirect()->back()->with($notification);
 
}

public function showSkill(){

   $skills = Skill::all();

   return view('backend.features.show_skill', compact('skills'));
}

public function editSkill($id){

$skills = Skill::findOrfail($id);

return view('backend.features.edit_skill',compact('skills'));
}

public function updateSkill(Request $request,$id){
    
    Skill::where('id',$id)->update([
                
        'skill_name' => $request->skill_name,
        'skill_capacity' => $request->skill_capacity,

    ]);

    return redirect()->route('show.skill');

}

public function deleteSkill($id){


Skill::where('id',$id)->delete();

return redirect()->back();


}

// the skill methode is end here

}