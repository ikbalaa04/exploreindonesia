<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\resetPasswordMail;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class forgotPasswordController extends Controller
{
    public function forgotPassword()
    {
        return view('cms.pages.auth.forgot');
    }
    public function postForgotPassword(Request $request)
    {
        try {
            $findEmail = User::where('email', $request->email);
            if ($findEmail->count() > 0) {
                // generate opt 
                $otp = md5(mt_rand(1000, 10000));
                $findEmail->update([
                    'otp' => $otp
                ]);
                // send email 
                $url = URL::to('/').'/reset-password/'.$otp.'/'.$request->email;
                $data = [
                    'email' => $request->email,
                    'url' => $url
                ];
                Mail::to($request->email)->send(New resetPasswordMail($data));
                return redirect()->route('login')->with('success', 'Reset password sudah dikirim ke '.$request->email.', silahkan cek email anda, tunggu beberapa saat maksimal 15 menit, jika tidak masuk ke email anda silahkan reset password ulang');
            } else {
                return redirect()->back()->with('gagal', 'email anda tidak ditemukan di data kami')->withInput($request->all());
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('gagal', $th->getMessage())->withInput($request->all());
        }
        // return view('cms.pages.mail.forgotPassword');
    }

    public function resetPassword($otp, $email)
    {
        try {
            $find = User::where('otp',$otp)->where('email', $email)->first();
            if ($find != null) {
                return view('cms.pages.auth.reset')->with([
                    'email' => $email,
                    'otp' => $otp
                ]);
            } else {
                return redirect('data-not-valid');
            }
        } catch (\Exception $th) {
            echo "<script>window.close();</script>";
        }
    }
    public function postResetPassword(Request $request,$otp, $email)
    {
        try {
            $find = User::where('otp',$otp)->where('email',$email);
            if ($find->count() > 0) {
                $update = $find->update([
                    'password' => bcrypt($request->password),
                    'otp' => rand(1000,5000),
                ]);
                return redirect()->route('login')->with('success','password berhasil direset silahkan masukan password baru anda')->withInput(['email' => $email]);
            } else {
                return redirect()->back()->with('gagal', 'upss... wrongs otp, find button in your email')->withInput($request->all());
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('gagal', $th->getMessage())->withInput($request->all());
        }
    }
}
