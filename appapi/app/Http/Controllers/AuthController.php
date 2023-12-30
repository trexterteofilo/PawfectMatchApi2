<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Petshooter;
use App\Models\Subscribers;
use App\Models\Petshooterapplication;
use App\Models\PetShooterCredentialImg;
use App\Models\Petshooterbreedtype;
use App\Models\Credential;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use DB;

use App\Http\Controllers\NotificationController;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class AuthController extends Controller
{
    public function multImageUpload1(Request $request)
    {
        $imagecount = 0;
        $files = $request->file;
        foreach ($files as $file) {

            //     $filename = time().'.png';
            //     $fileDB  = URL::to('/').'/storage/'.$path.'/'.$filename;


            //      $imagecount++;

            //    // $crendentials = Credential::where('petshooter_id', $id)->first();
            //     $credentials->create([
            //        'petshooter_id' => auth()->user()->id,
            //         'image' => $fileDB ,

            //     ]);
            //\Illuminate\Support\Facades\Storage::disk($path)->put($filename, $file);
            // $file->storeAs('public/storage/', $file->getClientOriginalName());
        }
        // return URL::to('/').'/storage/'.$path.'/'.$filename;
        return response([

            'message' => "Success from api"
        ], 200);

    }

    // public function getpetshooterdetails()
    // {
    //     $userID = Auth::user()->userID;
    //     $petshooter = Petshooter::select(
    //         'petshooter_id',
    //         'contact_number',
    //         'category',
    //         'experience'
    //     )
    //         ->where('petshooter_id', $userID)->get();
    //     return response([
    //         'petshooter' => $petshooter,
    //     ], 200);
    // }

    //update pet shooter details
    public function updatepetshooterdetails(Request $request)
    {
        $userID = Auth::user()->userID;
        $petshooter = Petshooter::where('petshooter_id', $userID)->get()->first();

        $petshooter->update(
            [
                'contact_number' => $request['contact_number'],
                'experience' => $request['experience'],
                'petshooterprice' => $request['petshooterprice'],
            ]
        );


        return response([
            'message' => 'Updated Successfully',
            'petshooter' => $petshooter,
        ], 200);
    }

    //input pet shooter details
    public function inputpetshooterdetails(Request $request)
    {

        $id = auth()->user()->userID;

        $petshooter = Petshooter::where('petshooter_id', $id)->first();

        // $multimages = $this->multImageUpload($request, 'multimages');

        $petshooter->update([
            'contact_number' => $request['contact_number'],
            'experience' => $request['experience'],
            'petshooterprice' => $request['petshooterprice'],

        ]);

        // $files=Request::file('images');
        //    foreach($files as $file){

        //     // $filename = time().'.png';
        //     // $fileDB  = URL::to('/').'/storage/'.$path.'/'.$filename;


        //     //  $imagecount++;

        //    // $crendentials = Credential::where('petshooter_id', $id)->first();
        // $credentials->create([
        //    'petshooter_id' => auth()->user()->userID,
        //     'image' => "imageee",

        // ]);
        //      //\Illuminate\Support\Facades\Storage::disk($path)->put($filename, $file);
        //     //$file->storeAs('public/storage/', $file->getClientOriginalName());
        // }

        // $request->validate([
        //     'images' => 'required',

        // ]);

        // $files = Request::file('images');
        // if ($files) {
        //     //images exists
        //     return response([
        //         'message' => 'successt',
        //         //  'petshooter' =>$petshooter,
        //         //  'imagecount' => $multimage
        //     ], 200);
        // } else {
        //     return response([
        //         'message' => 'success',
        //         //  'petshooter' =>$petshooter,
        //         //  'imagecount' => $multimage
        //     ], 200);
        // }


        return response([
            'message' => 'success',
            'petshooterID' => $id,
            //  'imagecount' => $multimage
        ], 200);

    }


    //submit pet shooter application
    public function submitApplication()
    {
        // Create a new CredentialImage record
        $petshooterApplication = Petshooterapplication::create([
            'petshooter_id' => auth()->user()->userID,
            'verification_status' => 'Pending',
        ]);

        return Response([
            'message' => 'Application submmitted',
            'petshooterapplication' => $petshooterApplication,
            //   'image' => $credentialImage->image_path
        ], 200);
    }


    public function uploadmultiimage(Request $request)
    {
        // $request->validate([
        //    // 'owner_id' => 'required',
        //     'pet_id' => 'required',
        //     'images' => 'required',
        //     //'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $images = $this->saveImage($request->image, 'petprofile');


        // Create a new CredentialImage record
        $credentialImage = PetShooterCredentialImg::create([
            'petshooter_id' => auth()->user()->userID,
            'image' => $images,
        ]);

        // // Handle and store each image
        // foreach ($request->file('images') as $key => $image) {
        //     $imageName = time() . '_' . $key . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('images'), $imageName);

        //     // Update the corresponding image_path column
        //     $credentialImage->update([
        //         'image_path_' . ($key + 1) => 'images/' . $imageName,
        //     ]);
        // }

        // return response()->json(['success' => $credentialImage]);

        return Response([
            'message' => 'Image added succesfully',
            // 'pet' => $pet,
            'image' => $credentialImage->images
        ], 200);
    }

    public function getImages($petId)
    {
        // Retrieve images for a specific pet
        $images = PetShooterCredentialImg::where('petshooter_id', $petId)->get();

        return response()->json(['images' => $images]);
    }

    public function getpetshootercred($petId)
    {
        // Retrieve images for a specific pet
        $credit = Petshooterbreedtype::where('petshooter_id', $petId)->get();

        return response()->json(['credit' => $credit]);
    }

    public function createbreedtype(Request $request)
    {
        // Create a new CredentialImage record
        $credType = Petshooterbreedtype::create([
            'petshooter_id' => auth()->user()->userID,
            'breedtype' => $request->breedtype,
        ]);

        return Response([
            'message' => 'Breed types added succesfully',
            // 'pet' => $pet,
            //   'image' => $credentialImage->image_path
        ], 200);
    }



    //   public function inputpetshooterdetails(Request $request)
    // {

    //     $id = auth()->user()->userID;

    //     $petshooter = Petshooter::update([
    //         'contact_number' => $request['contact_number'],
    //         'category' => $request['category'],
    //         'experience' => $request['experience'],

    //         //  $multimages = $this->multImageUpload($request, 'multimages', $id)
    //     ]);

    //     return response([
    //         'message' => 'Success',
    //         'petshooter' => $petshooter,
    //         //   'imagecount' => $multimage
    //     ], 200);

    // }
    //all users
    // get all posts
    public function getusers()
    {
        return response([
            'users' => User::orderBy('created_at', 'desc')->get()
        ], 200);
    }


    //change email
    public function change_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Email Already Exists',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        if (Hash::check($request->email, $user->email)) {
            return response()->json([
                'message' => 'Email already exists',
            ], 400);


        } else {
            $user->update([
                'email' => $request->email
            ]);

            return response()->json([
                'message' => 'Change Email succesfully',
            ], 200);
        }


    }

    //change password
    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'Change Password succesfully',
            ], 200);

        } else {
            return response()->json([
                'message' => 'Old Password does not match',
                'errors' => $validator->errors()
            ], 400);
        }


    }

    //get shooter 
    public function getShooters()
    {
        $user = array();
        $user = Auth::User();

        $shooter = User::where('accounttype', 'petshooter')->get();
        //$shooterData = petShooter:: all();

        // foreach($doctor as $info){

        // }
    }

    //Register user
    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            // 'subid' => 'required|string',
            // 'subprice' => 'required|string',

            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'bio' => 'nullable|string',
            'address' => 'required|string',
            'age' => 'required|string',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'image' => 'nullable|string',
            'accounttype' => 'required|string',
            'birthdate' => 'required|string',

        ]);

        if ($request['image'] == "null") {
            $user = User::create([

                'firstname' => $attrs['firstname'],
                'lastname' => $attrs['lastname'],
                'bio' => $attrs['bio'],
                'address' => $attrs['address'],
                'age' => $attrs['age'],
                'gender' => $attrs['gender'],
                'email' => $attrs['email'],
                'password' => bcrypt($attrs['password']),
                'image' => null,
                'accounttype' => $attrs['accounttype'],
                'role' => 2,
                'accountstatus' => 'Active',
                'device_id' => $request->device_id,
                'birthdate' => $attrs['birthdate'],
            ]);

        } else {
            $image = $this->saveImage($request->image, 'profiles');
            $user = User::create([
                'firstname' => $attrs['firstname'],
                'lastname' => $attrs['lastname'],
                'bio' => $attrs['bio'],
                'address' => $attrs['address'],
                'age' => $attrs['age'],
                'gender' => $attrs['gender'],
                'email' => $attrs['email'],
                'password' => bcrypt($attrs['password']),
                'image' => $image,
                'accounttype' => $attrs['accounttype'],
                'role' => 2,
                'device_id' => $request->device_id,
                'accountstatus' => 'Active',
                'birthdate' => $attrs['birthdate'],

            ]);

            if ($attrs['accounttype'] == 'petshooter' || $attrs['accounttype'] == 'dual') {
                $petshooter = Petshooter::create([
                    'petshooter_id' => $user->userID,
                ]);
            }

            $notif = new NotificationController();

            $users = User::where('userID', $user->userID)->first();


            $name = $users->firstname;
            $title = 'Hello ' . $name;
            $body = 'Welcome to Pawfectmatch!';
            $type = 'Greetings';

            $notif->notifunc($type, $title, $body, $request->device_id, $users->userID, $users->userID);


            // $credentials = Credential::create([
            //    'petshooter_id' =>$user->id,
            // ]);

            //$multimages = $this->multImageUpl     oad($request, 'multimages');

        }

        $getUserID = $user->userID;

        $subscriber = Subscribers::create([

            'user_id' => $getUserID,
            'subs_id' => $request->sub_id,
            'price' => $request->price,

        ]);
        // $subs = Subscribers::create([
        //     'user_id' => $user->userID,
        //     'subs_id' => $attrs['subid'],
        //     'price' => $attrs['subprice'],
        // ]);
        //return user & token in response
        return response([
            'user' => $user,
            'subscriber' => $subscriber,
            //'petshooter' =>$petshooter,
            'token' => $user->createToken('secret')->plainTextToken,
            'message' => "Success"
        ], 200);
    }


    /**
     * Validates user credential
     *
     * @param LoginRequest $request
     * @return array
     */
    private function isValidCredential(LoginRequest $request): array
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();
        if ($user === null) {
            return [
                'success' => false,
                'message' => 'Invalid Credential'
            ];
        }

        if (Hash::check($data['password'], $user->password)) {
            return [
                'success' => true,
                'user' => $user
            ];
        }

        return [
            'success' => false,
            'message' => 'Password is not matched',
        ];

    }


    /**
     * Logins a user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function logintest(LoginRequest $request): JsonResponse
    {
        $isValid = $this->isValidCredential($request);

        if (!$isValid['success']) {
            return $this->error($isValid['message'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user = $isValid['user'];
        $token = $user->createToken(User::USER_TOKEN);

        return $this->success([
            'user' => $user,
            'token' => $token->plainTextToken
        ], 'Login successfully!');

    }
    /**
     * 
     * 
     *  @return JsonResponse
     */

    public function loginWithToken()
    {

        return $this->success(auth()->user(), 'Login success');
    }





    // login user first function
    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            //'role' => 2,
        ]);

        // attempt login
        if (!Auth::attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
        // attempt login
        $userrole = auth()->user()->role;
        // $userrole =$userid->role;
        if ($userrole != 2) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }


        //return user & token in response
        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function getUserSubs()
    {
        $usersubs = Subscribers::where('user_id', auth()->user()->userID)->pluck('subs_id');
        $subs = Subscription::where('id', $usersubs)->get();

        return response([
            'subs' => $subs,
        ], 200);
    }


    // logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success.'
        ], 200);
    }


    // get user details
    public function user()
    {
        return response([
            'user' => auth()->user()
        ], 200);
    }


    // update user
    public function update(Request $request)
    {
        $attrs = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'address' => 'required|string',
            'age' => 'required|string',
            'bio' => 'nullable|string',

        ]);

        if ($request['image'] == null) {
            auth()->user()->update([
                'firstname' => $attrs['firstname'],
                'lastname' => $attrs['lastname'],
                'bio' => $attrs['bio'],
                'age' => $attrs['age'],
                'address' => $attrs['address'],
            ]);

        } else {
            $image = $this->saveImage($request->image, 'profiles');
            auth()->user()->update([
                'firstname' => $attrs['firstname'],
                'image' => $image,
                'lastname' => $attrs['lastname'],
                'bio' => $attrs['bio'],
                'age' => $attrs['age'],
                'address' => $attrs['address'],
            ]);
        }


        return response([
            'message' => 'User updated.',
            'user' => auth()->user()
        ], 200);


    }



    //////////////////////WEB///////////////////////////
    //view REGISTER page
    public function adminRegister()
    {
        return view('register');
    }
    // post REGISTER page
    public function registerPost(Request $request)
    {
        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        //  $user->username = $request->name;
        $user->accounttype = "admin";
        $user->role = 1;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect('/login')->with('success', 'Register successfully');

        //return back()->with('error', 'Something went wrong');
    }

    //view LOGIN page
    public function adminLogin()
    {
        return view('login');
    }

    //LOGIN user
    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 1,
        ];



        if (Auth::attempt($credentials)) {
            return redirect('/home')->with('success', 'Login success');
        }
        return back()->with('error', 'Invalid credentials');
    }

    // Logout USER
    public function adminLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}