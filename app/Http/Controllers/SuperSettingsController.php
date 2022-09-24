<?php

namespace App\Http\Controllers;

use App\Models\SuperSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class SuperSettingsController extends Controller
{
    //
    public function changeLanguage($lang = 'en')
    {
        $langs = SuperSettings::LANGS;
        if (!in_array($lang, $langs)) {
            abort(403, 'Udefind Selected Language');
        }
        $array_lang_key_val = [
            'Arabic' => 'ar',
            'English' => 'en',
        ];

        App::setlocale($array_lang_key_val[$lang]);

        $super = auth('super')->user();
        $superSettings = $super->settings;
        $isSaved = true;


        if (!empty($superSettings)) {
            $superSettings->lang = $lang;
            $isSaved = $superSettings->save();
        } else {
            $superSettings = new SuperSettings();
            $superSettings->lang = $lang;
            $superSettings->super_id = $super->id;
            $isSaved = $superSettings->save();
        }

        return redirect(URL::previous())->with([
            'message' => $isSaved ? __('Language updated successfully') : __('Failed to update language'),
        ]);
    }
}
