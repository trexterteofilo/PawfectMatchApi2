<?php
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\manageAccountController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PetShooterApplicationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ChartController;
use App\Models\Adoption;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth::routes([
//     'verify'=> true
// ]

// );

//Route::get('/messages', [MessageController::class, 'create'])->name('message');
// Route::get('/inputpay', [HomeController::class, 'inside'])->name('inside');

Route::get('/register', [AuthController::class, 'adminRegister'])->name('register');

Route::group(['middleware' => 'guest'], function () {

    //ADMIN REGISTER
    Route::get('/register', [AuthController::class, 'adminRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    //ADMIN LOGIN
    Route::get('/login', [AuthController::class, 'adminLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    //Route::resource('login', loginController::class);


    //Paypal
    Route::group(['prefix' => 'payment-mobile'], function () {
        Route::get('/', 'PaymentController@payment')->name('payment-mobile');
        Route::get('set-payment-method/{name}', 'PaymentController@set_payment_method')->name('set-payment-method');
    });
    Route::post('pay-paypal', 'PaypalPaymentController@payWithpaypal')->name('pay-paypal');
    Route::get('paypal-status', 'PaypalPaymentController@getPaymentStatus')->name('paypal-status');
    Route::get('payment-success', 'PaymentController@success')->name('payment-success');
    Route::get('payment-fail', 'PaymentController@fail')->name('payment-fail');






    //PAYPAL
    Route::get('/paypal', [PaypalController::class, 'viewpaypal']);
    Route::post('/paypalpost', [PaypalController::class, 'paypal'])->name('paypal');
    // Route::post('/billingplans', [PaypalController::class, 'paypal'])->name('paypal');
    Route::get('/success', [PaypalController::class, 'success'])->name('success');
    Route::get('/cancel', [PaypalController::class, 'cancel'])->name('cancel');
});

Route::group(['middleware' => 'auth'], function () {
    //HOME route 
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'adminLogout'])->name('logout');

    //SETTINGS route
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings');
    //Edit Profile
    Route::post('/settings/profile', [SettingsController::class, 'adminEditProfile'])->name('editProfile');
    Route::post('/settings/password', [SettingsController::class, 'adminChangePassword'])->name('changePassword');

    //VIEW REPORTS route
    //  Route::get('/reports', [ReportsController::class, 'reports'])->name('reports');

    //VIEW ADoption Table route
    // Route::get('/reports/adoptions', [ReportsController::class, 'adoptions'])->name('adoptionreports');
    // // Route::get('/adoptions', [ReportsController::class, 'index'])->name('reports');
    // Route::controller(ReportsController::class)->group(function () {
    //     Route::get('/adoptions', 'index');
    // });

    //Route::get('/adoptions', [ReportsController::class, 'index']);
    Route::get('/reports/adoptions', [ReportsController::class, 'adoptions'])->name('adoptionreports');
    Route::get('reports/adoptions/{id}', [ReportsController::class, 'showAdoption']);

    //VIEW Booking Table route
    Route::get('/reports/bookings', [ReportsController::class, 'bookings'])->name('bookingreports');

    Route::get('reports/bookings/{id}', [ReportsController::class, 'showBooking']);
    //VIEW Agreement Table route

    Route::get('/reports/agreements', [ReportsController::class, 'agreements'])->name('agreementreports');

    Route::get('reports/agreements/{id}', [ReportsController::class, 'showAgreement']);


    //Route::get("/adoptions", AdoptionController::class);

    //SUBSCRIPTION route
    Route::get('/subscription', [SubscriptionController::class, 'subcription'])->name('subs');
    //Edit Subscription
    Route::get('/subscription/{id}', [SubscriptionController::class, 'showSubs'])->name('showSubs');
    Route::get('/subscription/edit/{id}', [SubscriptionController::class, 'viewEditSubs'])->name('editSubs');
    Route::get('/subscription/{id}/edit', [SubscriptionController::class, 'findSubBenefit'])->name('subBenefit');
    Route::post('/subscription/benefits/{id}', [SubscriptionController::class, 'editSubBenefit'])->name('editSubBenefit');
    Route::post('/subscription/editsubscription/{id}', [SubscriptionController::class, 'editSubs'])->name('editSubscription');
    Route::delete('/subscription/benefits/delete/{id}', [SubscriptionController::class, 'deleteSubBenefits'])->name('deleteSubBenefits');
    Route::post('/subscription/benefits/add/{id}', [SubscriptionController::class, 'addSubBenefits'])->name('addSubBenefits');


    //Income REPORTS
    Route::get("/monthly-report", [ChartController::class, 'displayTotalIncomeByMonth']);
    Route::get("/annual-report", [ChartController::class, 'displayYearlyIncome']);


    //Manage accounts
    //manage pet owners
    Route::get('/manageAccounts/petowners', [manageAccountController::class, 'viewOwners'])->name('manageOwners');
    Route::get('/manageAccounts/petowners/{id}', [manageAccountController::class, 'showOwners'])->name('showOwners');
    Route::get('/manageAccounts/petowners/{id}/Cat', [manageAccountController::class, 'showCatOwners'])->name('showCatOwners');
    Route::get('/manageAccounts/petowners/find/{id}', [manageAccountController::class, 'findOwner'])->name('findOwnerId');
    Route::get('/manageAccounts/petowners/{id}/Dog', [manageAccountController::class, 'showDogOwners'])->name('showDogOwners');
    Route::get('/manageAccounts/petowners/{id}/Hamster', [manageAccountController::class, 'showHamsterOwners'])->name('showHamsterOwners');
    Route::get('/manageAccounts/petowners/{id}/Rabbit', [manageAccountController::class, 'showRabbitOwners'])->name('showRabbitOwners');
    Route::get('/manageAccounts/petowners/{id}/Bird', [manageAccountController::class, 'showBirdOwners'])->name('showBirdOwners');


    //Update user account status
    Route::post('/manageAccounts/petowners/active/{id}', [manageAccountController::class, 'activateUser'])->name('activateUser');
    Route::post('/manageAccounts/petowners/deact/{id}', [manageAccountController::class, 'deactUser'])->name('deactUser');

    //manage pet shooters
    Route::get('/manageAccounts/petshooters', [manageAccountController::class, 'viewPetshooters'])->name('managePetshooters');
    Route::get('manageAccounts/petshooters/{id}', [manageAccountController::class, 'showPetshooters']);
    //manage duals
    Route::get('/manageAccounts/dual', [manageAccountController::class, 'viewDual'])->name('manageDual');
    Route::get('manageAccounts/dual/{id}', [manageAccountController::class, 'showDual'])->name('showDual');
    Route::get('/manageAccounts/dual/{id}/Cat', [manageAccountController::class, 'showCatDual'])->name('showCatDual');
    Route::get('/manageAccounts/dual/{id}/Dog', [manageAccountController::class, 'showDogDual'])->name('showDogDual');
    Route::get('/manageAccounts/dual/{id}/Hamster', [manageAccountController::class, 'showHamsterDual'])->name('showHamsterDual');
    Route::get('/manageAccounts/dual/{id}/Rabbit', [manageAccountController::class, 'showRabbitDual'])->name('showRabbitDual');
    Route::get('/manageAccounts/dual/{id}/Bird', [manageAccountController::class, 'showBirdDual'])->name('showBirdDual');

    //manage pet
    Route::get('/manageAccounts/pets', [manageAccountController::class, 'viewPets'])->name('managePet');
    Route::get('manageAccounts/pets/{id}', [manageAccountController::class, 'showPets']);

    Route::get('/manageAccounts/petowners/search', [manageAccountController::class, 'searchOwners']);

    ///Pet shooter Application
    //RECEIVED/PENDING
    Route::get('/petshooterApplication/received', [PetShooterApplicationController::class, 'viewPendingApp'])->name('viewReceivedApp');
    Route::get('/petshooterApplication/received/{id}', [PetShooterApplicationController::class, 'showPendingApp']);
    //ACCEPTED
    Route::get('/petshooterApplication/approved', [PetShooterApplicationController::class, 'viewAcceptedApp'])->name('viewAcceptedApp');
    // Route::get('manageAccounts/pets/{id}', [PetShooterApplicationController::class, 'showPets']);
    //DECLINED
    Route::get('/petshooterApplication/declined', [PetShooterApplicationController::class, 'viewDeclinedApp'])->name('viewDeclinedApp');
    // Route::get('manageAccounts/pets/{id}', [PetShooterApplicationController::class, 'showPets']);
    //Update Pet shooter verification status
    Route::post('/petshooterApplication/received/accept/{id}', [PetShooterApplicationController::class, 'approveApplication'])->name('approveApplication');
    Route::post('/petshooterApplication/received/decline/{id}', [PetShooterApplicationController::class, 'declineApplication'])->name('declineApplication');

    //ACCOUNTS PDF 
    Route::get('generate-petowner-pdf', [PDFController::class, 'generatePetOwnerPDF']);
    Route::get('generate-petshooter-pdf', [PDFController::class, 'generatePetShooterPDF']);
    Route::get('generate-dual-pdf', [PDFController::class, 'generateDualPDF']);
    Route::get('generate-pet-pdf', [PDFController::class, 'generatePetPDF']);

    //REPORTS PDF 
    Route::get('generate-booking-pdf', [PDFController::class, 'generateBookingPDF']);
    Route::get('generate-agreement-pdf', [PDFController::class, 'generateAgreementPDF']);
    Route::get('generate-adoption-pdf', [PDFController::class, 'generateAdoptionPDF']);



});