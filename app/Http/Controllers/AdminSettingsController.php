<?php

namespace App\Http\Controllers;

use App\Models\AdminSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminSettingsController extends Controller
{
    //

    public function changeLanguage($lang = 'en')
    {
        $langs = AdminSettings::LANGS;
        if (!in_array($lang, $langs)) {
            abort(403, 'Udefind Selected Language');
        }
        $array_lang_key_val = [
            'Arabic' => 'ar',
            'English' => 'en',
        ];

        App::setlocale($array_lang_key_val[$lang]);
        // session()->put([
        //     'lang' => $array_lang_key_val[$lang],
        // ]);

        $admin = auth('admin')->user();
        $adminSettings = $admin->settings;
        $isSaved = true;

        if (!empty($adminSettings)) {
            $adminSettings->lang = $lang;
            $isSaved = $adminSettings->save();
        } else {
            $adminSettings = new AdminSettings();
            $adminSettings->lang = $lang;
            $adminSettings->admin_id = $admin->id;
            $isSaved = $adminSettings->save();
        }

        return redirect()->route('admin.dashboard')->with([
            'message' => $isSaved ? 'Language updated successfully' : 'Failed to update language',
        ]);
    }
}
