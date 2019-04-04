<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public $successStatus = 200;

    public function create(Request $request)
    {


        if (Profile::where('user_id', '=', Auth::id())->exists()) {
            // user found
            $profile = Profile::where('user_id', '=', Auth::id());
            return response()->json(['error' => "Profile exist, update instead", 'data' => $profile->get()], 401);
        } else {


            Log::info('Loging the user profile: ' . $request);

            $validator = Validator::make($request->all(), [
                'full_name' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }


            $profile = new Profile();
            $profile->user_id = Auth::id();
            $profile->interests = json_encode(explode(",", $request->get('interests')));
            $profile->hobbies = json_encode(explode(",", $request->get('hobbies')));
            $profile->full_name = $request->get('full_name');
            $profile->instagram = $request->get('instagram');
            $profile->facebook = $request->get('facebook');
            $profile->twitter = $request->get('twitter');
            $profile->whatsapp = $request->get('whatsapp');
            $profile->bio = $request->get('bio');
            $profile->cover_photo_path = $request->get('cover_photo_path');
            $profile->profile_photo_path = $request->get('profile_photo_path');
            if (!empty($request->get('profile_photo_path'))) {
                $profile->profile_photo_path = $this->createImageFromBase64($request->get('profile_photo_path'), "profile");
            }
            if (!empty($request->get('cover_photo_path'))) {

                $profile->cover_photo_path = $this->createImageFromBase64($request->get('cover_photo_path'), "cover");
            }
            $profile->user()->associate($request->user());
            $user = User::find(Auth::id());
            $user->profile()->save($profile);
            return response()->json(['data' => $profile], $this->successStatus);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function list(Profile $profile)
    {
        //
        $user = Auth::id();
        $profile = Profile::where('user_id', $user)->orderBy('id', 'asc')->get();
        $profile[0]['image_path'] = env('IMG_PATH');
        return response()->json(['data' => $profile], $this->successStatus);
    }

    public function createImageFromBase64($file_data, $area = "image")
    {
        $file_name = $area . '_' . time() . '.png'; //generating unique file name;
        @list($type, $file_data) = explode(';', $file_data);
        @list(, $file_data) = explode(',', $file_data);
        if ($file_data != "") { // storing image in storage/app/public Folder

            Storage::disk("local")->put($file_name, base64_decode($file_data));
        } else {
            return false;
        }
        $path = Storage::disk('public')->path($file_name);
        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $thumbnailpath = $storagePath . $file_name;

        if (preg_match("/cover/i", $area)) {
            $img = Image::make($thumbnailpath)->fit(600, 200);
        } elseif (preg_match("/profile/i", $area)) {
            $img = Image::make($thumbnailpath)->fit(200);
        } else {

            $img = Image::make($thumbnailpath);
        }
        $img->save($thumbnailpath);

        return substr(strrchr($file_name, "/"), 1);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile, $id)
    {
        //
        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $profile = Profile::findOrFail($id);
        $input = $request->all();
        $input['hobbies'] = json_encode(explode(",", $request->get('hobbies')));
        $input['interests'] = json_encode(explode(",", $request->get('interests')));
        if (!empty($request->get('profile_photo_path'))) {
            $img = $storagePath . "public/img/" . $profile->profile_photo_path;
            if (file_exists($img)) {
                unlink($img);
            } else {
                Log::info('file not found: ' . $img);
            }

            $input['profile_photo_path'] = $this->createImageFromBase64($request->get('profile_photo_path'), "public/img/profile", "profile");

        }
        if (!empty($request->get('cover_photo_path'))) {
            $img = $storagePath . "public/img/" . $profile->cover_photo_path;
            if (file_exists($img)) {
                unlink($img);
            } else {
                Log::info('file not found: ' . $img);
            }

            $input['cover_photo_path'] = $this->createImageFromBase64($request->get('cover_photo_path'), "public/img/cover", "cover");

        }
        $profile->fill($input)->save();
        return response()->json(['data' => $profile], $this->successStatus);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
