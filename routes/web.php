<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SettingControler;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WinnersController;
use App\Http\Controllers\auth\forgotPassword;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\AuthverifyEmailController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeLandController;
use App\Http\Controllers\QuestionsController;
use App\Http\Middleware\availableForBet;
use App\Http\Middleware\availableToAnswer;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\IsUser;
use App\Http\Middleware\notLogin;
use App\Models\questions;
use App\Models\Winners;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






Route::get('/', [HomeLandController::class, 'home'])->name('home');


Route::prefix('/Auth')

    ->name('auth.')
    ->middleware(notLogin::class)
    ->group(function () {
        Route::get('/sendResetPassword', [forgotPassword::class, 'sendForgotPassCode'])->name('sendForgotPassCode');
        Route::get('resetPass', [forgotPassword::class, 'EnterResetPassPage'])->name('EnterResetPassPage');
        Route::get('/register', [RegisterController::class, 'gotoRegisterPage'])->name('RegisterPage');
        Route::get('/login', [LoginController::class, 'gotoLoginPage'])->name('LoginPage');
        Route::post('/register/save', [RegisterController::class, 'register'])->name('register');
        Route::post('/login/save', [LoginController::class, 'login'])->name('login');

        Route::post('/EnterResetPassCode', [forgotPassword::class, 'EnterResetPassCode'])->name('EnterResetPassCode');
    });

Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware(isLogin::class)
    ->name('logout');

Route::get('/verifyEmail', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'index'])
    ->middleware(isLogin::class)
    ->name('verifyEmailPage');



Route::get('/sendverifyMobile', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'index'])->name('verifyMobile');



Route::post('/VerifyMobileCode', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'verifyMobile'])
    ->name('checkMobileVerify');



Route::get('verifyNumber', [\App\Http\Controllers\auth\AuthverifyEmailController::class, 'EnterVerifyCodePage'])->name('EnterVerifyCodePage');









Route::prefix('/admin-dashboard')
    ->name('adminn.')
    ->middleware([isLogin::class, isAdmin::class])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('panel');

        Route::resource('questions', QuestionsController::class);


        Route::post('/deleteQuestion', [QuestionsController::class, 'destroy'])->name('deleteQuestion');

        Route::get('/questionWinner/{questionId}', [WinnersController::class, 'show'])->name('questionWinner');

        Route::get('/winners', [WinnersController::class, 'index'])->name('winners.index');

        Route::resource('/users', UserController::class);


        Route::post('/usersupdate', [UserController::class, 'update'])->name('usersupdate');

        Route::put('/qImg', [QuestionsController::class, 'updateImg'])->name('questionimg.update');

        Route::get('/betquestionPage/{id}', [QuestionsController::class, 'betquestionPage'])->name('betquestionPage');

        Route::post('/betquestion', [QuestionsController::class, 'bet'])->middleware([isAdmin::class])->name('betquestion');

        Route::get('/betResult/{id}', [QuestionsController::class, 'betResult'])->middleware(isAdmin::class)->name('BetResult');


        Route::get('/setting', [SettingControler::class, 'index'])->name('setting.index');

        Route::post('/editPay', [SettingControler::class, 'edit'])->name('setting.editPay');
    });



Route::prefix('/user-dashboard')
    ->middleware([isLogin::class, IsUser::class])
    ->name('user.')
    ->group(function () {


        Route::get('/', [UserController::class, 'dashboard'])->name('panel');



        Route::get('/ResetPass', [forgotPassword::class, 'ResetPassPage'])->name('ResetPassPage');


        Route::post('/newPass', [forgotPassword::class, 'EnterNew'])->name('EnterNewPass');

        Route::get('/questions/{id}', [QuestionsController::class, 'userShow'])->name('questions.show');


        Route::get('/winners', [WinnersController::class, 'userIndex'])->name('winners');

        Route::get('/myHistory', [QuestionsController::class, 'myHistory'])->name('myHistory');

        Route::get('/user/{id}' , [UserController::class , 'showUser'])->name('showUser');

        Route::get('/myLastQuestion', [QuestionsController::class, 'myLastQuestion'])->name('myLastQuestion');

        Route::get('/CompetitionList', [UserController::class, 'Competition'])->name('CompetitionList');
    });


Route::prefix('/questions')
    ->middleware([isLogin::class, availableToAnswer::class])
    ->name('question.')
    ->group(function () {

        Route::get('/exam', [QuestionsController::class, 'exam'])->name('exam');

        Route::post('/answer', [QuestionsController::class, 'answer'])->name('answer');
    });


Route::prefix('/payment')
    ->middleware([isLogin::class])
    ->name('payment.')
    ->group(function () {

        Route::get('/', [Controller::class, 'paymentPage'])->name('paymentPage');

        Route::post('/PaymentPost', [Controller::class, 'payment'])->name('post');
        Route::get('/PaymentVerify', [Controller::class, 'verifyy'])->name('verify');
    });





Route::post('/checkNumber', [UserController::class, 'checkNumber']);
