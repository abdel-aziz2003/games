<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WelcomeController extends Controller
{
    public function megzy() {}

    public function notice()
    {
        return view('notice');
    }

    public function index()
    {
        $game_list = Game::inRandomOrder()->limit(16)->get();
        return view('welcome', ['game_list' => $game_list]);
    }

    public function filter(Request $request, $route, $ext = '--')
    {
        $ft = '';
        if ($request->input('search') != '') {
            $ft = $ft . "search__" . $request->input('search') . "--";
        }
        if ($request->input('category') != '') {
            $ft = $ft . "category__" . $request->input('category') . "--";
        }
        if ($request->input('drange') != '') {
            $ft = $ft . "drange__" . $request->input('drange') . "--";
        }


        if ($ft != '') {
            $ft = substr($ft, 0, -2);
        }

        return redirect()->route($route, ['filter' => $ft]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if (config('settings.g_site_key') != '' && config('settings.g_secret_key') != '') {
            $captcha = validate_captcha($request->input('g-recaptcha-response'));
            if ($captcha == false) {
                return redirect()->back()->withInput()->withErrors(['Captcha failed']);
            }
        }

        //send message
        Mail::to(config('settings.email'))->send(new ContactEmail($request));

        return redirect()->back()->with('status', 'Message sent successfully. We will get back to you as soon as possible.');
    }
}
