<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public $base_url;
    public $profile_path;
    public function __construct()
    {
        $this->base_url = url('/');
        $this->profile_path = '/profile_images/';
    }


    /**
     * Profile Update data customer.
     */
    public function updateProfile(Request $request)
    {

        $token = $request->header('token');
        $user_id = $request->user_id;
        $base_url =  $this->base_url;
        $user = DB::table('user_devices')
            ->where('user_devices.login_token', '=', $token)
            ->where('user_devices.status', '=', 1)
            ->count();
        if ($user == '' || $user == null || $user == 0) {
            $result['status'] = false;
            $result['message'] = "Token given is invalid, Please login again.";
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }

        // Get the currently authenticated user
        $user = User::where('id', $user_id)->first();
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:10',
            'alternate_mobile' => 'required|string|max:10',
            'flat_no' => 'required|string',
            'area' => 'required|string',
            'landmark' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
        ]);


        // Check if the validation fails
        if ($validator->fails()) {
            $result['status'] = false;
            $result['message'] = $validator->errors()->first();
            $result['data'] = (object)[];
            return response()->json($result, 200);
        }

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('mobile');
        $user->alternate_phone = $request->input('alternate_mobile');
        $user->flat_no = $request->input('flat_no');
        $user->area = $request->input('area');
        $user->password = Hash::make('123456');
        $user->landmark = $request->input('landmark');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->pincode = $request->input('pincode');
        $user->is_first_time = 0;

        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $destinationPath = 'profile_images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $user->avatar = $profileImage;
        }

        $user->save();

        $users = User::where('id', $user_id)->get();

        $data = $users->map(function ($user) use ($base_url, $token) {
            return collect($user)->except(['password', 'email_verified_at', 'otp', 'otp_expires_at', 'remember_token'])
                ->put('user_id', $user['id'])
                ->put('avatar', ($user['avatar']) ? $base_url . $this->profile_path . $user['avatar'] : '')
                ->toArray();
        })->first();

        // Return a response
        return response()->json(['status' => true, 'message' => 'Profile updated successfully!', 'data' => $data], 200);
    }

    /**
     * Profile get data customer.
     */
    public function getProfile(Request $request)
    {
        try {
            $token = $request->header('token');
            $user_id = $request->user_id;
            $base_url =  $this->base_url;
            $user = DB::table('user_devices')
                ->where('user_devices.login_token', '=', $token)
                ->where('user_devices.status', '=', 1)
                ->count();
            if ($user == '' || $user == null || $user == 0) {
                $result['status'] = false;
                $result['message'] = "Token given is invalid, Please login again.";
                $result['data'] = (object)[];
                return response()->json($result, 200);
            }

            // Get the currently authenticated user
            $user = User::with('MemberBatch')->where('id', $user_id)->get();
            $data = $user->map(function ($user) use ($base_url, $token) {
                return collect($user)->except(['password', 'email_verified_at', 'otp', 'otp_expires_at', 'remember_token', 'member_batch'])
                    ->put('user_id', $user['id'])
                    ->put('headway_id', ($user->MemberBatch) ? (string)$user->MemberBatch['headway_id'] : '--')
                    ->put('batch_number', ($user->MemberBatch) ? $user->MemberBatch['batch'] : '--')
                    ->put('avatar', ($user['avatar']) ? $base_url . $this->profile_path . $user['avatar'] : '')
                    ->toArray();
            })->first();

            // Return a response
            return response()->json(['status' => true, 'message' => 'Profile updated successfully!', 'data' => $data], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Something went wrong', 'error' => $th->getMessage()], 200);
        }
    }
}
