<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Image;
use App\Models\Notification;
use App\Models\PasswordReset;
use App\Models\PhoneData;
use App\Models\Product;
use App\Notifications\NotifyOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        if (!$request->name)
            return response()->json(['msg' => 'username required']);
        if (!$request->email)
            return response()->json(['msg' => 'email required']);
        if (!$request->password)
            return response()->json(['msg' => 'password required']);
        if (!$request->address)
            return response()->json(['msg' => 'address required']);
        if (!$request->phone)
            return response()->json(['msg' => 'phone required']);
        if (!$request->confirm_password)
            return response()->json(['msg' => 'confirm password required']);
        if($request->confirm_password != $request->password)
            return response()->json(['msg' => 'confirm password dont match password']);

        $old_name = User::where('name', $request->name)->first();
        if ($old_name)
            return response()->json(['msg' => 'username exist in the database']);
        $old_email = User::where('email', $request->email)->first();
        if ($old_email)
            return response()->json(['msg' => 'email exist in the database']);
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL))
            return response()->json(['msg' => 'invalid email']);
        if(! is_numeric($request->phone))
            return response()->json(['msg' => 'mobile must be a number']);
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'active_code' => str_random(6),
            'password' => bcrypt($request->get('password')),
            'tokens' => str_random(150)
        ]);
        $data = [
            'name' => $user->name,
            'subject' => 'this is an activation code',
            'content' => $user->active_code
        ];

        Mail::send('emails.verify', $data, function ($message) use ($user) {
            $message->from('smtp@Mazad.com', 'Verification@سوق الحراى')
                ->to($user->email)
                ->subject('سوق الحراى');
        });

        return response()->json(['msg' => 'User created successfully, please follow your mail to activate your account.']);
    }
    private function receiveData($user_id, $mac, $token)
    {
        if (!$user_id)
            return response()->json(['msg' => 'user_id required']);
        if (!$mac)
            return response()->json(['msg' => 'mac required']);
        if (!$token)
            return response()->json(['msg' => 'token required']);
        $user = User::where('id', $user_id)->first();
        if (!$user)
            return response()->json(['msg' => 'invalid user_id']);

        $old_phone_data = PhoneData::where('mac', $mac)->first();
        if (!$old_phone_data) {
            $phone_data = new PhoneData();
            $phone_data->mac = $mac;
            $phone_data->token = $token;
            $phone_data->user_id = $user->id;
            $phone_data->save();
        } else {
            $old_phone_data->token = $token;
            $old_phone_data->user_id = $user->id;
            $old_phone_data->save();
        }

    }
    public function login(Request $request)
    {
        if (!$request->token)
            return response()->json(['msg' => 'token required']);
        if (!$request->mac)
            return response()->json(['msg' => 'mac required']);
        if (!$request->name)
            return response()->json(['msg' => 'name required']);
        if (!$request->password)
            return response()->json(['msg' => 'password required']);

        $user = User::where('name', $request->name)->first();

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password, 'activate' => 1])) {
            $this->receiveData(Auth::user()->id, $request->mac, $request->token);
            if (Auth::user()->tokens)
                return response()->json(['token' => Auth::user()->tokens]);
            else {
                Auth::user()->tokens = str_random(150);
                Auth::user()->save();
                return response()->json(['token' => Auth::user()->tokens]);
            }
        }
        return response()->json(['msg' => 'invalid data or user not activate']);
    }
    public function AuthUser($token)
    {
        $user = User::where('tokens', $token)->first();
        if(! $user)
            return response()->json(['msg' => 'invalid token']);
        return response()->json($user);

    }
    // verification your mail
    public function verifyMail(Request $request)
    {
        if (!$request->email)
            return response()->json(['msg' => 'email required']);
        if (!$request->code)
            return response()->json(['msg' => 'active_code required']);
        $user = User::where('email', $request->email)
            ->where('active_code', $request->code)->first();
        if ($user == NULL) {
            return response()->json(['msg' => 'invalid data']);
        } else {
            $user->activate = 1;
            $user->save();

            return response()->json(['msg' => 'activation done successfully, please login.']);
        }

    }

    public function again(Request $request)
    {
        if(! $request->email)
            return response()->json(['msg', 'email required']);

        $user = User::where('email', request('email'))->first();

        if ($user == NULL) {
            return response()->json(['msg' => 'invalid email, please confirm and try again.']);
        } elseif ($user->activate == 1) {
            return response()->json(['msg' => 'this email is already activated, please retrieve your data and try again.']);
        }else {

            $data = [
                'name' => $user->name,
                'subject' => 'this is an activation code',
                'content' => $user->active_code
            ];

            Mail::send('emails.verify', $data, function ($message) use ($user) {
                $message->from('smtp@Mazad.com', 'Verification@سوق الحراى')
                    ->to($user->email)
                    ->subject('سوق الحراى');
            });

            return response()->json(['msg' => 'activation code resend to your mail, please follow your mail to activate it']);

        }
    }
    // forget password
    public function getResetToken(Request $request)
    {
        if(! $request->email)
            return response()->json(['msg', 'email required']);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json(['msg', 'invalid email']);
        $old_reset_password = PasswordReset::where('email', $request->email)->first();
        if(! $old_reset_password) {
            $reset_password = PasswordReset::create([
                'email' => $request->email,
                'token' => str_random(20)
            ]);
            $data = [
                'name' => $user->name,
                'subject' => 'this is token to reset password',
                'token' => $reset_password->token
            ];
        }else{
            $data = [
                'name' => $user->name,
                'subject' => 'this is token to reset password',
                'token' => $old_reset_password->token
            ];
        }
        Mail::send('emails.resetPassword', $data, function ($message) use ($user) {
            $message->from('smtp@Mazad.com', 'Verification@سوق الحراى')
                ->to($user->email)
                ->subject('سوق الحراى');
        });
        return response()->json(['msg' => 'Code sent to your mail, please follow mail.']);

    }
    public function reset(Request $request)
    {
        if (!$request->email)
            return response()->json(['msg' => 'email required']);
        if (!$request->code)
            return response()->json(['msg' => 'code required']);
        if (!$request->new_password)
            return response()->json(['msg' => 'new password required']);
        $user = User::where('email', $request->email)->first();
        $reset_password = PasswordReset::where('email', $request->email)
            ->where('token', $request->code)->first();

        if ($reset_password == NULL || $user == null) {
            return response()->json(['msg', 'invalid data']);
        } else {
            $user->password = bcrypt($request->new_password);
            $user->save();
            PasswordReset::destroy($reset_password->id);
            return response()->json(['msg' => 'password updated successfully.']);
        }
    }
    public function notifications($token){
        $user = User::where('tokens', $token)->first();
        if(! $user)
            return response()->json(['msg' => 'invalid data']);
        $user->unreadNotifications->markAsRead();
        $notifications = Notification::where('notifiable_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        foreach ($notifications as $notification) {
            $data = json_decode($notification->data);
            $notification['data'] = $data;
        }

        return response()->json($notifications);
    }
    public function unreadNotifications($token)
    {
        $user = User::where('tokens', $token)->first();
        $count = $user->unreadNotifications->count();
        return response()->json($count);
    }
    public function index(){
        $users=User::where('role',2)->get();
        return view('olx.users.index',compact('users'));
    }
    public function destroy($id)
    {
        Product::where('user_id', $id)->delete();
        Contact::where('user_id', $id)->delete();
        User::destroy($id);
    }
}