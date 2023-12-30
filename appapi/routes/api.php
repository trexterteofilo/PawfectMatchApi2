<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ReportsController;
use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Petcontroller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\AdoptionAgreementController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CredentialImageController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//savenotif
Route::post('/savenotifss', [NotificationController::class, 'savenotifss']);

Route::post('/getbookingtime', [BookingController::class, 'getbookingtime']);

Route::post('/imageupload', [ImageController::class, 'imageUpload']);



Route::get("notify", [NotificationController::class, "testqueues"]);
Route::post("/notifyapp", [NotificationController::class, "notifyapp"]);

Route::get('/getusers', [AuthController::class, 'getusers']);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/loginapi', [AuthController::class, 'login']);
// Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/pettest', [Petcontroller::class, 'petcontrollertest']);



//Get Pet Preference Route
Route::get('/getpet', [Petcontroller::class, 'getpreferences']);

///////Subscription
Route::get('/getAllSubscription', [SubscriptionController::class, 'getAllSubscription']); // all comments of a post
Route::get('/getAllBenefits', [SubscriptionController::class, 'getAllBenefits']); // all comments of a post 

///new
Route::post('/getSubs', [SubscriptionController::class, 'getSubs']); // all comments of a post
Route::post('/getBenefits', [SubscriptionController::class, 'getBenefits']); // all comments of a post
Route::post('/getCons', [SubscriptionController::class, 'getCons']); // x

////////NEW SUBS
Route::post('/getSubss', [SubscriptionController::class, 'getSubss']);
Route::post('/getBenefitss', [SubscriptionController::class, 'getBenefitss']); // all comments of a post
Route::post('/getConss', [SubscriptionController::class, 'getConss']); // x


Route::prefix('auth')
    ->as('auth.')
    ->group(function () {
        Route::post('login', [AuthController::class, 'logintest'])->name('logintest');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login_with_token', [AuthController::class, 'loginWithToken'])
            ->middleware('auth:sanctum')
            ->name('login_with_token');
        Route::get('logout', [AuthController::class, 'logout'])
            ->middleware('auth:sanctum')
            ->name('logout');
    });

// Route::middleware('auth:sanctum')->group(function (){
//     Route::apiResource('chats', ChatController::class)->only(['index','store','show']);
//     Route::apiResource('chat_message', ChatMessageController::class)->only(['index','store']);
//     Route::apiResource('user', UserController::class)->only(['index']);
// });

// Route::apiResource('chat', ChatController::class)->only(['index','store','show']);
// Route::apiResource('chat_message', ChatMessageController::class)->only(['index','store']);
// Route::apiResource('user', UserController::class)->only(['index']);


// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //get specific user subscription info
    Route::get('/getUserSubs', [AuthController::class, 'getUserSubs']);


    //pet shooter multImageUpload
    Route::post('/inputpetshooterdetails', [AuthController::class, 'inputpetshooterdetails']);
    Route::post('/updatepetshooterdetails', [AuthController::class, 'updatepetshooterdetails']);
    Route::post('/submitApplication', [AuthController::class, 'submitApplication']);

    //UNUSED:
    Route::post('/multimageupload', [AuthController::class, 'multImageUpload']);
    Route::get('/getpetshooterdetails', [AuthController::class, 'getpetshooterdetails']);


    //PET CREDENTIAL IMAGES & TYPE
    Route::post('/uploadmultiimage', [CredentialImageController::class, 'uploadmultiimage']);
    Route::get('/credential-images/{petId}', [CredentialImageController::class, 'getImages']);
    Route::post('/createcredtype', [CredentialImageController::class, 'createcredtype']);

    //PET SHOOTER CREDENTIAL IMAGES & BREED TYPE getpetshootercred
    Route::post('/uploadpetshootercredimage', [AuthController::class, 'uploadmultiimage']);
    Route::get('/getshootercredentialimages/{id}', [AuthController::class, 'getImages']);
    Route::get('/getshooterbreedtype/{id}', [AuthController::class, 'getpetshootercred']);
    Route::post('/postpetshooterbreedtype', [AuthController::class, 'createbreedtype']);

    //SEARCH
    //breed
    // Route::get('/searchbreed/{pettype}', [BreedingController::class, 'searchbreed']);
    // //adoption
    // Route::get('/searchadopt/{pettype}', [AdoptionController::class, 'searchadopt']);


    //Pet Preference Route petpreferenceedit
    Route::post('/petpreferenceinput', [Petcontroller::class, 'petpreferenceinput']);
    Route::post('/petpreferenceedit', [Petcontroller::class, 'petpreferenceedit']);
    Route::get('/getpreference', [Petcontroller::class, 'getpreferences']);


    Route::apiResource('chat', ChatController::class)->only(['index', 'store', 'show']);
    Route::apiResource('chat_message', ChatMessageController::class)->only(['index', 'store']);
    Route::apiResource('user', UserController::class)->only(['index']);

    // Route::get('/user',  [AuthController::class, 'getuser']);
    // Route::apiResource('user', AuthController::class)->only(['getusers']);




    //Booking getuserpetshooter

    Route::post('/reschedulebooking', [BookingController::class, 'reschedulebooking']);
    Route::post('/completebooking', [BookingController::class, 'completebooking']);
    Route::post('/cancelbooking', [BookingController::class, 'cancelbooking']);
    Route::post('/createbooking', [BookingController::class, 'createbooking']);
    // Route::post('/createbooking', [BookingController::class, 'createbooking']);
    Route::post('/getpublicbookings', [BookingController::class, 'getpublicbookings']);
    Route::get('/getuserbooking', [BookingController::class, 'getuserbooking']);
    Route::get('/getuserpetshooter', [BookingController::class, 'getuserpetshooter']);
    Route::get('/getrequestlistbooking', [BookingController::class, 'getrequestlistbooking']);
    Route::get('/getcompletedlistbooking', [BookingController::class, 'getcompletedlistbooking']);
    Route::get('/getcancelledlistbooking', [BookingController::class, 'getcancelledlistbooking']);
    Route::get('/getpendinglistbooking', [BookingController::class, 'getpendinglistbooking']);
    Route::get('/getlistofpetshooters', [BookingController::class, 'getlistofpetshooters']);
    Route::get('/getspecificpetshooters/{id}', [BookingController::class, 'getspecificpetshooters']);
    Route::get('/bookpetshooter', [BookingController::class, 'getspecificpetshooters']);
    Route::get('/getpendinglistbookingpetshooter', [BookingController::class, 'getpendinglistbookingpetshooter']);
    Route::get('/getcancelledlistbookingpetshooter', [BookingController::class, 'getcancelledlistbookingpetshooter']);
    Route::get('/getcompletedlistbookingetshooter', [BookingController::class, 'getcompletedlistbookingetshooter']);



    //Adoption Request viewcompletedadoptionreq
    Route::get('/viewcompletedadoptionreq', [AdoptionController::class, 'viewcompletedadoptionreq']);
    Route::get('/viewcanceledadoptionreq', [AdoptionController::class, 'viewcanceledadoptionreq']);
    Route::get('/viewincomingadoptionreq', [AdoptionController::class, 'viewincomingadoptionreq']);
    Route::get('/viewacceptedadoptionreq', [AdoptionController::class, 'viewacceptedadoptionreq']);
    Route::post('/completeadoption_request', [AdoptionController::class, 'completeadoption_request']);
    Route::post('/acceptadoptionrequest', [AdoptionController::class, 'acceptadoptionrequest']);
    Route::post('/canceladoptionrequest', [AdoptionController::class, 'canceladoptionrequest']);
    Route::get('/checkadtoptionrequest/{id}', [AdoptionController::class, 'checkAdoptionRequest']);
    Route::post('/adoptionrequest', [AdoptionController::class, 'requestAdoption']);
    Route::get('/getadtoptionrequest', [AdoptionController::class, 'getrequestAdoptionList']);
    Route::get('/getmyadoptionreqlist', [AdoptionController::class, 'getmytrequestAdoptionList']);

    //adoption
    Route::post('/adoptionpost', [AdoptionController::class, 'adoptionPost']);
    Route::get('/getadoptions', [AdoptionController::class, 'getAdoptions']);
    //get all User's adoption posts
    Route::get('/getadoptionposts', [AdoptionController::class, 'getAdoptionPosts']);
    Route::post('/getalladoptions', [AdoptionController::class, 'getAllAdoptions']);
    Route::get('/getpetadoptionprofile/{id}', [AdoptionController::class, 'getpetadoptionprofile']);
    //delete Adoption Post
    Route::delete('/deleteadoption/{id}', [AdoptionController::class, 'deleteAdoptPost']);
    Route::put('/editadoption/{id}', [AdoptionController::class, 'editAdoptPost']); // update pz`ost


    // Route for Report-Adoption
    Route::get('/getreports', [ReportsController::class, 'getreports']);

    // Route for Report-Agreement
    Route::get('/getreportsAgreement', [ReportsController::class, 'getreportsAgreement']);

    // Route for Report-Booking- Request

    Route::get('/getreportsBooking', [ReportsController::class, 'getreportsBooking']);

    // Pet
    Route::get('/getpet/{id}', [Petcontroller::class, 'getSpecificPet']);
    Route::get('/getpetcredentials/{id}', [Petcontroller::class, 'getcredentials']);
    Route::get('/getpetcredentialsimg/{id}', [Petcontroller::class, 'getcredential_img']);

    //get pet
    Route::get('/getallpet', [Petcontroller::class, 'getallpet']);

    //getpets with users
    Route::get('/petsWithUser', [Petcontroller::class, 'petsWithUser']);

    // Pet Register Route
    Route::post('/registerpet', [Petcontroller::class, 'petregister']);
    Route::get('/getpet', [Petcontroller::class, 'getpet']);
    Route::post('/deletepet/{id}', [Petcontroller::class, 'delete']);
    //update pets
    Route::post('/petupdate', [Petcontroller::class, 'petupdate']);
    //get pet
    Route::get('/getpet', [Petcontroller::class, 'getPet']);

    // Pet Register Route
    Route::post('/registerpet', [Petcontroller::class, 'petregister']);
    Route::get('/getpetprofile', [Petcontroller::class, 'viewpetprofile']);
    Route::get('/getpet', [Petcontroller::class, 'viewpetprofile']);
    Route::post('/updatepet', [Petcontroller::class, 'viewpetprofile']);


    Route::post('/checkpetadd', [Petcontroller::class, 'checkpetadd']);
    Route::post('/checkpetbreed', [Petcontroller::class, 'checkpetbreed']);
    Route::post('/checkpetadoption', [Petcontroller::class, 'checkpetadoption']);


    //BREED matchingalgo
    Route::post('/breedpost', [BreedingController::class, 'breedingPost']);
    Route::get('/getbreeding', [BreedingController::class, 'getBreeding']);
    //Route::get('/getcatsbreeding', [BreedingController::class, 'getCatsBreeding']);
    Route::post('/getmatchbreeding', [BreedingController::class, 'matchingalgo']);





    Route::delete('/deletebreeding/{id}', [BreedingController::class, 'deleteBreedPost']);
    Route::get('/getbreedingposts', [BreedingController::class, 'getBreedingPosts']);
    Route::post('/breedingagreement', [BreedingController::class, 'breedingAgreement']);

    //SEARCHbreed
    Route::get('/searchbreed/{pettype}', [BreedingController::class, 'searchbreed']);
    //SEARCHadoption
    Route::get('/searchadopt/{pettype}', [AdoptionController::class, 'searchadopt']);

    //Agreement
    //Agreement completeagreementrequest
    Route::get('/getrequestorpendingagreements', [AgreementController::class, 'getrequestorpendingagreements']);
    Route::get('/getrecipientpendingagreements', [AgreementController::class, 'getrecipientpendingagreements']);
    Route::get('/getcancelledagreements', [AgreementController::class, 'getcancelledagreements']);
    Route::get('/getcompletedagreements', [AgreementController::class, 'getcompletedagreements']);
    Route::post('/completeagreementrequest', [AgreementController::class, 'completeagreementrequest']);
    Route::post('/cancelagreementrequest', [AgreementController::class, 'cancelagreementrequest']);

    Route::get('/getagreement', [AgreementController::class, 'getAgreementRequest']);
    Route::post('/createagreement', [AgreementController::class, 'createagreement']);
    Route::get('/agreementlist', [AgreementController::class, 'agreementList']);

    //ADOPTIONagreement
    Route::post('/createadoptionagreement', [AdoptionAgreementController::class, 'createadoptionagreement']);
    Route::get('/getadoptionagreement', [AdoptionAgreementController::class, 'getadoptionagreement']);
    Route::get('/getspecificadoptionagreement/{id}', [AdoptionAgreementController::class, 'getspecificadoptionagreement']);
    // User
    Route::get('/userapi', [AuthController::class, 'user']);
    Route::put('/userapi', [AuthController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getuserid', [AuthController::class, 'getuserid']);


    Route::post('/changepass', [AuthController::class, 'change_password']);
    Route::post('/changeemail', [AuthController::class, 'change_email']);
    // Post
    Route::get('/posts', [PostController::class, 'index']); // all posts
    Route::post('/posts', [PostController::class, 'store']); // create post
    Route::get('/posts/{id}', [PostController::class, 'show']); // get single post
    Route::put('/posts/{id}', [PostController::class, 'update']); // update pz`sost
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // delete post

    // Comment
    Route::get('/posts/{id}/comments', [CommentController::class, 'index']); // all comments of a post
    Route::post('/posts/{id}/comments', [CommentController::class, 'store']); // create comment on a post
    Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

    // Like
    Route::post('/posts/{id}/likes', [LikeController::class, 'likeOrUnlike']); // like or dislike back a post
    // Route::get('/matchingalgo', [BreedingController::class, 'matchingalgo']); // all comments of a post



    // ///////Subscription
    // Route::get('/getAllSubscription', [SubscriptionController::class, 'getAllSubscription']); // all comments of a post

    // ///new
    // Route::post('/getSubs', [SubscriptionController::class, 'getSubs']); // all comments of a post
    // Route::post('/getBenefits', [SubscriptionController::class, 'getBenefits']); // all comments of a post
    // Route::post('/getCons', [SubscriptionController::class, 'getCons']); // all comments of a post
    Route::get('/getsubstype', [SubscriptionController::class, 'getsubstype']); // all comments of a post 

});
