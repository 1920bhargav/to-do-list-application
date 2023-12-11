<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Lang;
use Auth;
use DB;
class PassportAuthController extends Controller
{
    public function signup(Request $request)
    {
        $id = '0';
        $validator = Validator::make($request->all(),[
            'full_name' => 'required|string|min:3|max:125',
            'email'     => 'required|string|email|unique:users,email,' . $id . ',id,is_deleted,0',
            'password'  => 'required',
            'phone'     => 'required',
            'address'   => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                Config::get('constants.rest_status_field_name') => 0,
                Config::get('constants.rest_message_field_name') => $validator->errors()->all()
            ], 200); // OK (200) being the HTTP response code
        }else{
            $appname = Config::get('constants.SITE_NAME');
            $data = [
                'full_name'      => $request->full_name,
                'email'          => $request->email,
                'password'       => Hash::make($request->password),
                'phone'          => $request->phone,
                'address'        => $request->address,
                'created_on'     => time(),
            ];
            
            $profile_picture = $request->file('profile_picture');
            if ($profile_picture) {
                $imageName = hash('sha1', $profile_picture->getClientOriginalName() . random_int (100, 1000000)).'.'.$profile_picture->extension();
                $profile_picture->move(public_path('images/profile_picture/'), $imageName);
                $data['profile_picture'] = "profile_picture/".$imageName;
            }
            $user = User::create($data);
            if ($user) {
                $user->assignRole('user');
                $token = $user->createToken($appname)->accessToken;
                $user_data = User::where('id',$user->id)->first();
                $res_data = [
                    'full_name' => $user_data->full_name,
                    'email' => $user_data->email,
                    'phone' => $user_data->phone,
                    'address' => $user_data->address,
                    'profile_picture' => (!empty($user_data->profile_picture)) ? $user_data->profile_picture : '',
                    'token' => $token
                ];
                
                return response()->json([
                    Config::get('constants.rest_status_field_name') => 1,
                    Config::get('constants.rest_message_field_name') => Lang::get('response.users.register_users_successful'),
                    Config::get('constants.rest_data_field_name') => $res_data
                ], 200); // OK (200) being the HTTP response code
            }else{
                return $this->errorResponse('Oops! Server error,please try after sometime.  ',500);
            }
        }
    }

    public function login(Request $request)
    {
        $data = [
            'email'     => $request->email,
            'password'     => $request->password,
        ];

        $validator = Validator::make($data,[
            'email'     => 'required|string|email|max:100',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                Config::get('constants.rest_status_field_name') => 0,
                Config::get('constants.rest_message_field_name') => $validator->errors()->all()
            ], 200); // OK (200) being the HTTP response code
        }else{
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                
                $user = Auth::user();
                $is_exists = DB::table('users')
                                ->where('id', $user->id)
                                ->where('active', 1)
                                ->where('is_deleted', 0)
                                ->exists();
                if($is_exists == 1)
                {
                    $res_data = [
                        'full_name' => $user->full_name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'address' => $user->address,
                        'profile_picture' => (!empty($user->profile_picture)) ? $user->profile_picture : '',
                        'token' => $user->createToken(Config::get('constants.SITE_NAME'))->accessToken
                    ];
                   
                    return response()->json([
                        Config::get('constants.rest_status_field_name') => 1,
                        Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_successful'),
                        Config::get('constants.rest_data_field_name') => $res_data
                    ], 200); // OK (200) being the HTTP response code
                }else{
                    return response()->json([
                        Config::get('constants.rest_status_field_name') => 0,
                        Config::get('constants.rest_message_field_name') =>  Lang::get('response.users.user_not_found')
                    ], 200); // OK (200) being the HTTP response code
                }
            } else {
                return response()->json([
                    Config::get('constants.rest_status_field_name') => 0,
                    Config::get('constants.rest_message_field_name') =>  "Unauthorized"
                ], 200); // OK (200) being the HTTP response code
            }
        }

        return response()->json([
            Config::get('constants.rest_status_field_name') => 0,
            Config::get('constants.rest_message_field_name') =>  Lang::get('response.users.something_wrong')
        ], 200); // OK (200) being the HTTP response code
    }

    public function social_signup(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'social_id' => 'required',
            'social_type' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                Config::get('constants.rest_status_field_name') => 0,
                Config::get('constants.rest_message_field_name') => $validator->errors()->all()
            ], 200); // OK (200) being the HTTP response code
        }
        $appname = Config::get('constants.SITE_NAME');
        $user_data = User::where('social_id', $request->social_id)->get()->first();
       
        if ($user_data) {
            $user_data->email = (!empty($request->email)) ? $request->email : '';
            $user_data->phone = (!empty($request->phone)) ? $request->phone : '';
            $user_data->full_name = (!empty($request->full_name)) ? $request->full_name : '';
            $user_data->save();
            $token = $user_data->createToken($appname)->accessToken;
            $data = array(
                'user_id' => $user_data->id,
                'email' => $user_data->email,
                'phone' => $user_data->phone,
                'full_name' => $user_data->full_name,
                'token' => $token
            );
            
            /* return user data */
            return response()->json([
                Config::get('constants.rest_status_field_name') => 1,
                Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_successful'),
                Config::get('constants.rest_data_field_name') => $data
            ], 200); // OK (200) being the HTTP response code
        } else {
            $email = $request->email;

            if ($email && $email != "") {
                $user_by_email = User::where('email', $request->email)->get()->first();
                if ($user_by_email){
                    $user_by_email->social_id = $request->social_id;
                    $user_by_email->social_type = $request->social_type;
                    if ($user_by_email->save()) {
                        $token = $user_by_email->createToken($appname)->accessToken;
                        $data = array(
                            'user_id' => $user_by_email->id,
                            'email' => $user_by_email->email,
                            'phone' => $user_by_email->phone,
                            'full_name' => $user_by_email->full_name,
                            'token' => $token
                        );
            
                        /* return user data */
                        return response()->json([
                            Config::get('constants.rest_status_field_name') => 1,
                            Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_successful'),
                            Config::get('constants.rest_data_field_name') => $data
                        ], 200); // OK (200) being the HTTP response code
                    } else {
                        return response()->json([
                            Config::get('constants.rest_status_field_name') => 0,
                            Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_unsuccessful')
                        ], 200); // OK (200) being the HTTP response code
                    }
                } else {
                    $register = User::create([
                        'email' => (!empty($user_data->email)) ? $user_data->email : '',
                        'phone' => (!empty($user_data->phone)) ? $user_data->phone : '',
                        'full_name' => (!empty($user_data->full_name)) ? $user_data->full_name : '',
                        'social_id' => $request->social_id,
                        'social_type' => $request->social_type,
                        'created_on' => time()
                    ]);
                    $user_by_social = User::where('social_id', $request->social_id)->get()->first();
                    if ($register) {
                        $token = $user_by_social->createToken($appname)->accessToken;
                        $data = array(
                            'user_id' => $user_by_social->id,
                            'email' => $user_by_social->email,
                            'phone' => $user_by_social->phone,
                            'full_name' => $user_by_social->full_name,
                            'token' => $token
                        );
                        return response()->json([
                            Config::get('constants.rest_status_field_name') => 1,
                            Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_successful'),
                            Config::get('constants.rest_data_field_name') => $data
                        ], 200); // OK (200) being the HTTP response code
                    } else {
                        return response()->json([
                            Config::get('constants.rest_status_field_name') => 1,
                            Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_unsuccessful')
                        ], 200); // OK (200) being the HTTP response code
                    }
                }
            } else {
                $register = User::create([
                    'email' => (!empty($user_data->email)) ? $user_data->email : '',
                    'phone' => (!empty($user_data->phone)) ? $user_data->phone : '',
                    'full_name' => (!empty($user_data->full_name)) ? $user_data->full_name : '',
                    'social_id' => $request->social_id,
                    'social_type' => $request->social_type,
                    'created_on' => time()
                ]);
                $user_by_social = User::where('social_id', $request->social_id)->get()->first();
                if ($register) {
                    $token = $user_by_social->createToken($appname)->accessToken;
                    $data = array(
                        'user_id' => $user_by_social->id,
                        'email' => $user_by_social->email,
                        'phone' => $user_by_social->phone,
                        'full_name' => $user_by_social->full_name,
                        'token' => $token
                    );
                    return response()->json([
                        Config::get('constants.rest_status_field_name') => 1,
                        Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_successful'),
                        Config::get('constants.rest_data_field_name') => $data
                    ], 200); // OK (200) being the HTTP response code
                } else {
                    return response()->json([
                        Config::get('constants.rest_status_field_name') => 1,
                        Config::get('constants.rest_message_field_name') => Lang::get('response.users.login_unsuccessful')
                    ], 200); // OK (200) being the HTTP response code
                }
            }
        }
    }

    public function change_password(Request $request) {
        $user = Auth::user();
        $id = $user->id;

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
                Config::get('constants.rest_status_field_name') => 0,
                Config::get('constants.rest_message_field_name') => $validator->errors()->all()
            ], 200); // OK (200) being the HTTP response code
        }
        
        $old_password = $request->input("old_password");
        $password = $request->input("new_password");

        if (Hash::check($old_password, $user->password)) {
            $user->update(['password' => Hash::make($password)]);
            $data['id'] = $id;
            
            return response()->json([
                Config::get('constants.rest_status_field_name') => 1,
                Config::get('constants.rest_message_field_name') => Lang::get('response.users.change_password_success'),
            ], 200); // OK (200) being the HTTP response code
        } else {
            return response()->json([
                Config::get('constants.rest_status_field_name') => 0,
                Config::get('constants.rest_message_field_name') => Lang::get('response.users.old_password_wrong')
            ], 200); // OK (200) being the HTTP response code
        }
    }
}
