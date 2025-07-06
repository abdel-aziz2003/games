<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{
    public function create()
    {
        return view('setting.create');
    }

    public function store(Request $request)
    {
        $table = Setting::find(1);
        $table->name = $request->input('name');
        $table->email = $request->input('email');
        $table->tell = $request->input('tell');
        $table->meta_keyword = $request->input('meta_keyword');
        $table->meta_description = $request->input('meta_description');
        $table->address = $request->input('address');
        $table->save();

        return redirect()->back()->with('status', 'Settings saved');
    }

    public function icon_create()
    {
        $info = Setting::find(1);
        return view('setting.icon_create', ['info' => $info]);
    }

    public function icon_store(Request $request)
    {
        $info = Setting::find(1);

        $request->validate([
            'logo' => 'nullable|image',
            'favicon' => 'nullable|image',
        ]);

        $table = $info;
        if ($request->hasFile('logo')) {
            unlink('public/images/' . $info->logo);
            $logo = $request->file('logo')->store('', 'images');
            $manager = new ImageManager(
                new Driver()
            );
            // open an image file
            $img = $manager->read(public_path('images/' . $logo));
            $img->resize(200, 50);
            $img->save();
            $table->logo = $logo;
        }
        if ($request->hasFile('favicon')) {
            unlink('public/images/' . $info->favicon);
            $favicon = $request->file('favicon')->store('', 'images');
            $manager = new ImageManager(
                new Driver()
            );
            // open an image file
            $img = $manager->read(public_path('images/' . $favicon));
            $img->resize(32, 32);
            $img->save();
            $table->favicon = $favicon;
        }
        $table->save();

        return redirect()->back()->with('status', 'Settings saved');
    }

    public function social_create()
    {
        return view('setting.social_create');
    }

    public function social_store(Request $request)
    {
        $table = Setting::find(1);

        $table->facebook = $request->input('facebook');
        $table->twitter = $request->input('twitter');
        $table->youtube = $request->input('youtube');
        $table->instagram = $request->input('instagram');

        $table->save();

        return redirect()->back()->with('status', 'Settings saved');
    }

    public function banner_create()
    {
        $info = Setting::find(1);
        return view('setting.banner_create', ['info' => $info]);
    }

    public function banner_store(Request $request)
    {
        $info = Setting::find(1);

        $request->validate([
            'home_banner' => 'nullable|image',
        ]);

        $table = $info;
        if ($request->hasFile('home_banner')) {
            unlink('public/images/' . $info->home_banner);
            $home_banner = $request->file('home_banner')->store('', 'images');
            $manager = new ImageManager(
                new Driver()
            );
            // open an image file
            $img = $manager->read(public_path('images/' . $home_banner));
            $img->resize(1050, 382);
            $img->save();
            $table->home_banner = $home_banner;
        }

        $table->save();

        return redirect()->back()->with('status', 'Banner saved');
    }

    public function adsense_create()
    {
        $info = Setting::find(1);
        return view('setting.adsense_create', ['info' => $info]);
    }

    public function adsense_store(Request $request)
    {
        $info = Setting::find(1);

        $table = $info;
        $table->adsense = $request->input('adsense');
        $table->save();

        return redirect()->back()->with('status', 'Settings saved');
    }

    public function advert_create()
    {
        $info = Setting::find(1);
        return view('setting.advert_create', ['info' => $info]);
    }
    public function advert_store(Request $request)
    {
        $info = Setting::find(1);

        $request->validate([
            'template_ad' => 'nullable|image',
            'game_ad' => 'nullable|image',
            'play_ad' => 'nullable|image',
        ]);

        $table = $info;
        if ($request->hasFile('template_ad')) {
            if($info->template_ad != '')
            {
            unlink('public/images/ads/' . $info->template_ad);
            }
            $template_ad = $request->file('template_ad')->store('', 'ads');
            $manager = new ImageManager(
                new Driver()
            );
            // open an image file
            $img = $manager->read(public_path('images/ads/' . $template_ad));
            $img->resize(1100, 150);
            $img->save();
            $table->template_ad = $template_ad;
        }

        if ($request->hasFile('game_ad')) {
            if($info->game_ad != '')
            {
            unlink('public/images/ads/' . $info->game_ad);
            }
            $game_ad = $request->file('game_ad')->store('', 'ads');
            $manager = new ImageManager(
                new Driver()
            );
            // open an image file
            $img = $manager->read(public_path('images/ads/' . $game_ad));
            $img->resize(357, 600);
            $img->save();
            $table->game_ad = $game_ad;
        }

        if ($request->hasFile('play_ad')) {
            if($info->play_ad != '')
            {
            unlink('public/images/ads/' . $info->play_ad);
            }
            $play_ad = $request->file('play_ad')->store('', 'ads');
            $manager = new ImageManager(
                new Driver()
            );
            // open an image file
            $img = $manager->read(public_path('images/ads/' . $play_ad));
            $img->resize(166, 166);
            $img->save();
            $table->play_ad = $play_ad;
        }

        $table->template_ad_link = $request->input('template_ad_link');
        $table->game_ad_link = $request->input('game_ad_link');
        $table->play_ad_link = $request->input('play_ad_link');

        $table->save();

        return redirect()->back()->with('status', 'Ads saved');
    }

    public function remove_ad($ad)
    {
        $info = Setting::find(1);
$pix = $info->$ad;
$ad_link = $ad."_link";

if($pix != '')
{
    unlink('public/images/ads/'.$pix);
}

$info->$ad = '';
$info->$ad_link = '';
$info->save();

return redirect()->back()->with('status', 'Ad removed');
    }

    public function captcha()
    {
        return view('setting.captcha');
    }

    public function captcha_store(Request $request)
    {
        $table = Setting::find(1);
        $table->g_site_key = $request->input('g_site_key');
        $table->g_secret_key = $request->input('g_secret_key');
        $table->save();

        return redirect()->back()->with('status', 'Settings saved');
    }

   
}