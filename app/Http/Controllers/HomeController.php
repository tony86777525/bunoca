<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\UserCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $message;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'page' => 'index',
        ]);
    }

    public function mail_check(Request $request)
    {
        $message = '驗證失敗!';
        $check = false;

        try {
            if ($request->has('token') && $request->has('user')) {
                $user = $request->input('user');
                $token = $request->input('token');
                $user = User::where('email', $user)->first();
                if (!empty($user)) {
                    if (!is_null($user['create_token'])) {
                        if ($user['create_token'] == $token) {
                            $user->update(['create_token' => NULL]);
                            $check = true;
                            $message = '驗證成功!' . "<br>" . '來去購物吧~!';
                        } else {
                            $message .= "<br>" . '驗證碼已失效 請重新取得驗證!';
                        }
                    } else {
                        $message .= "<br>" . '會員已驗證! 來去購物吧~!';
                    }
                } else {
                    $message .= "<br>" . '無此會員!';
                }
            } else {
                $message .= "<br>" . '操作錯誤!';
            }
        }catch (Exception $e) {
            $message .= '操作錯誤!';
        }

        $this->message['message'] = $message;
        $this->message['check'] = $check;

        return view('home', [
            'page' => 'result',
            'message' => $this->message
        ]);
    }

    public function order()
    {
        return view('order');
    }
}
