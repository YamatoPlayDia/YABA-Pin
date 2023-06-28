<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Profile;

// class ProfileController extends Controller
// {
//     public function index()
//     {
//         $profiles = Profile::all();
//         return response()->json($profiles);
//     }

//     public function show($id)
//     {
//         $profile = Profile::find($id);

//         if ($profile) {
//             return response()->json($profile);
//         } else {
//             return response()->json(['error' => 'Profile not found'], 404);
//         }
//     }

//     public function store(Request $request)
//     {
//         $profile = new Profile;
//         $profile->name = $request->name;
//         $profile->email = $request->email;
//         $profile->profile = $request->profile;
//         $profile->phone = $request->phone;
//         $profile->save();

//         return response()->json($profile);
//     }

//     public function update(Request $request, $id)
//     {
//         $profile = Profile::find($id);
//         $profile->name = $request->name;
//         $profile->email = $request->email;
//         $profile->profile = $request->profile;
//         $profile->phone = $request->phone;
//         $profile->save();

//         return response()->json($profile);
//     }

//     public function destroy($id)
//     {
//         $profile = Profile::find($id);
//         $profile->delete();

//         return response()->json('Profile deleted successfully');
//     }
// }
