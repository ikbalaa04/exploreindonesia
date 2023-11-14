<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class registerController extends Controller
{
    public function getregister()
    {
        $type = 'register';
        return view('cms.pages.auth.register')->with(
            [
                'type' => $type
            ]
        );
    }
    public function register(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'email' => 'required|unique:users|email',
                'password' => 'required',
                'name' => 'required'
            ]);
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);
            $data['mobile_phone'] = $this->formatPhone($data['mobile_phone']);
            $data['user_type'] = 'customer';
            $data['status'] = '1';
            $data['email_verified_at'] = Carbon::now();
            $data['is_send_first_register'] = 1;
            $create = User::create($data);
            return redirect()->back()->with('success', 'User berhasil dibuat silahkan login');
        } catch (\Exception $th) {
            return redirect()->back()->with('gagal', $th->getMessage())->withInput($request->all());
        }
    }

    public function join($code, $email)
    {
        try {
            $decrypted = Crypt::decrypt($code);
            $emailDecrypted = Crypt::decrypt($email);
            $user = User::where('email',$emailDecrypted)->where('otp',$decrypted)->count();
            if ($user > 0) {
                $credentials = [
                    'email' => $emailDecrypted,
                    'password' => 'L'.$decrypted
                ];
                if (Auth::attempt($credentials)) {
                    
                    return view('cms.pages.auth.resetPassword', [
                        'email' => $emailDecrypted
                    ]);
                } else {
                    return redirect()->route('web.home')->with('failed', 'Credentials not match.');    
                }
            } else {
                return redirect()->route('web.home')->with('failed', 'Code tidak valid, silahkan cek ulang kembali email anda.');
            }

        } catch (\Exception $th) {
            if ($th->getMessage() == 'The payload is invalid.') {
                return redirect()->route('web.home')->with('failed', 'Code tidak valid, silahkan cek ulang kembali email anda.');
            } else {
                return redirect()->route('web.home')->with('failed', $th->getMessage());
            }
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            // update user 
            $user = User::where('email', $request->email)->update([
                'password' => bcrypt($request->password),
                'email_verified_at' => Carbon::now(),
                'otp' => null,
                'status' => 1,
            ]);
            if ($user) {
                return redirect()->route('web.home');
            } else {
                return redirect()->route('web.home')->with('failed', 'something went wrongs');
            }
        } catch (\Exception $th) {
            return redirect()->route('web.home')->with('failed', $th->getMessage());
        }
    }
}
