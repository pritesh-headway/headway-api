<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ApiController;
use App\Http\Controllers\API\V1\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/sendOtp', [ApiController::class, 'sendOtp']);
Route::post('v1/login', [ApiController::class, 'login']);
Route::post('v1/resend_otp', [ApiController::class, 'resendOtp']);
Route::post('v1/profile/update', [ProfileController::class, 'updateProfile']);
Route::post('v1/profile/getProfile', [ProfileController::class, 'getProfile']);
Route::post('v1/getBlogsList', [ApiController::class, 'getBlogsList']);
Route::post('v1/getPlanList', [ApiController::class, 'getPlanList']);
Route::post('v1/getPlanDetail', [ApiController::class, 'getPlanDetail']);
Route::post('v1/getAddOnsList', [ApiController::class, 'getAddOnsList']);
Route::post('v1/getCoursesList', [ApiController::class, 'getCoursesList']);
Route::post('v1/getCMDVisitList', [ApiController::class, 'getCMDVisitList']);
Route::post('v1/getStoreVisitList', [ApiController::class, 'getStoreVisitList']);
Route::post('v1/getModulesList', [ApiController::class, 'getModulesList']);
Route::post('v1/getServicesList', [ApiController::class, 'getServicesList']);
Route::post('v1/getMeetingList', [ApiController::class, 'getMeetingList']);
Route::post('v1/getVideoList', [ApiController::class, 'getVideoList']);
Route::post('v1/getTraningVideoList', [ApiController::class, 'getTraningVideoList']);
Route::post('v1/getWebPolicy', [ApiController::class, 'getWebPolicy']);
Route::post('v1/getWebSitePolicy', [ApiController::class, 'getWebSitePolicy']);
Route::post('v1/setNotificationUser', [ApiController::class, 'setNotificationUser']);
Route::post('v1/getStartupList', [ApiController::class, 'getStartupList']);
Route::post('v1/getDevelopmentBusinessList', [ApiController::class, 'getDevelopmentBusinessList']);
Route::post('v1/getHRList', [ApiController::class, 'getHRList']);
Route::post('v1/membershipForm', [ApiController::class, 'membershipForm']);
Route::post('v1/contactUs', [ApiController::class, 'contactUs']);
Route::post('v1/getAboutUs', [ApiController::class, 'getAboutUs']);
Route::post('v1/getFaqsData', [ApiController::class, 'getFaqsData']);
Route::post('v1/getStrategyGraphics', [ApiController::class, 'getStrategyGraphics']);
Route::post('v1/getMembershipPolicy', [ApiController::class, 'getMembershipPolicy']);
Route::post('v1/getDataProcessingSupport', [ApiController::class, 'getDataProcessingSupport']);
Route::post('v1/getMarketingStrategy', [ApiController::class, 'getMarketingStrategy']);
Route::post('v1/getDashboardData', [ApiController::class, 'getDashboardData']);
Route::post('v1/getNotificationUser', [ApiController::class, 'getNotificationUser']);
Route::post('v1/getHeadwayITList', [ApiController::class, 'getHeadwayITList']);
Route::post('v1/getJewelleryVidyapithList', [ApiController::class, 'getJewelleryVidyapithList']);
Route::post('v1/getBusinessList', [ApiController::class, 'getBusinessList']);
Route::post('v1/getAddOnDetailsById', [ApiController::class, 'getAddOnDetailsById']);
Route::post('v1/getHeadwayInitiativeList', [ApiController::class, 'getHeadwayInitiativeList']);
Route::post('v1/getPrivacyPolicy', [ApiController::class, 'getPrivacyPolicy']);
Route::post('v1/getTermsCondition', [ApiController::class, 'getTermsCondition']);
Route::post('v1/getDataConfig', [ApiController::class, 'getDataConfig']);
Route::post('v1/addOnPurchase', [ApiController::class, 'addOnPurchase']);
Route::post('v1/getAccountInfo', [ApiController::class, 'getAccountInfo']);
Route::post('v1/getMyPlan', [ApiController::class, 'getMyPlan']);
Route::post('/v1/logout', [ApiController::class, 'logout']);


// v2 version API routes
Route::post('v1/get_dashboard_data', [ApiController::class, 'getDashboardDataV2']);
Route::post('v1/about_us', [ApiController::class, 'getAboutUsV2']);
Route::post('v1/about_startup', [ApiController::class, 'getAboutStartupV2']);
Route::post('v1/mmb_gallaries', [ApiController::class, 'getMmbGallaries']);
Route::post('v1/service_plan_list', [ApiController::class, 'getServicePlanList']);
Route::post('v1/ssu_gallaries', [ApiController::class, 'getSsuGallaries']);
Route::post('v1/blogs_list', [ApiController::class, 'getBlogsListV2']);
Route::post('v1/blog_details', [ApiController::class, 'getBlogDetails']);
Route::post('v1/meet_our_team', [ApiController::class, 'getMeetOurTeam']);
Route::post('v1/user_add_on_service', [ApiController::class, 'getUserAddOnService']);
Route::post('v1/get_user_profile', [ApiController::class, 'getUserProfile']);
Route::post('v1/get_notification_data', [ApiController::class, 'getNotificationData']);
Route::post('v1/newsletter_subscription', [ApiController::class, 'newsletterSubscription']);
Route::post('v1/update_notification_data', [ApiController::class, 'updateNotificationData']);
Route::post('v1/user_profile_update', [ApiController::class, 'updateUserProfile']);
Route::post('v1/gen_settings', [ApiController::class, 'getGeneralSettings']);
