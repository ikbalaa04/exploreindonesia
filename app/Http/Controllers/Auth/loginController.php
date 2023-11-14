<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class loginController extends Controller
{
    public function getlogin()
    {
        $type = 'login';
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'partner') {
                return redirect()->route('cms.dashboard');
            } else {
                return redirect()->route('dashboard.user.profile');
            }

        }
        return view('cms.pages.auth.login')->with([
            'type' => $type
        ]);
    }
    public function notlogin()
    {
        return redirect()->route('login')->with('login', 'harap login terlebih dahulu');
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($data)) {
            $item = User::where('email', $request->email)->first();
            if($item->user_type == 'admin' && $item->status == '1') {
                return redirect()->route('cms.dashboard');
            } elseif ($item->user_type == 'customer' && $item->status == '1') {
                return (!empty(Session::get('backUrl'))) ? redirect(Session::get('backUrl')) : redirect()->route('url.intended');
            }
            return redirect()->back()->with('gagal', 'user belum aktif, periksa email anda')->withInput($data);
        } else {
            return redirect()->back()->with('gagal', 'email atau password salah')->withInput($data);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect('/');
    }

    // script sosial media auth
    public function redirectProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function providerCallback(\Request $request)
    {
        try {
            $userGoogle = Socialite::driver('google')->user();
            $user = User::where('email',$userGoogle->getEmail())->first();
            if ($user == null) {
                $name = substr($userGoogle->getEmail(),0,strpos($userGoogle->getEmail(),'@'));
                $create = User::create([
                    'name' => $userGoogle->getName(),
                    'email' => $userGoogle->getEmail(),
                    'password' => bcrypt($name),
                    'mobile_phone' => '08',
                    'user_type' => 'customer',
                    'status' => '1',
                    'email_verified_at' => Carbon::now(),
                    'is_send_first_register' => 1,
                    'pict' => $userGoogle->getAvatar(),
                    'google_id' => $userGoogle->getId()
                ]);
                Auth::login($create);
                return redirect()->route('web.home')->with('success', 'Terimakasih sudah mendaftar '.$create['name']);
            } else {
                Auth::login($user);
                return redirect()->route('web.home')->with('success', 'Selamat datang kembali baginda '.$user['name']);
            }
        } catch (\Exception $th) {
            return redirect()->back()->with(['gagal',$th->getMessage()]);
        }
    }
}
