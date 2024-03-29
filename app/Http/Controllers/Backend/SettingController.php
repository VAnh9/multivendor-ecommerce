<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Currencies;

class SettingController extends Controller
{
    public function index() {

      $generalSettings = GeneralSetting::first();
      return view('admin.settings.index', compact('generalSettings'));
    }

    public function updateGeneralSettings(Request $request) {

      $request->validate([
        'site_name' => ['required', 'max:200'],
        'layout' => ['required'],
        'contact_email' => ['required', 'max:200', 'email'],
        'currency_name' => ['required'],
        'currency_icon' => ['required', 'max:200'],
        'time_zone' => ['required']
      ]);

      GeneralSetting::updateOrCreate(
        ['id' => 1],
        [
          'site_name' => $request->site_name,
          'layout' => $request->layout,
          'contact_email' => $request->contact_email,
          'currency_name' => $request->currency_name,
          'currency_icon' => $request->currency_icon,
          'time_zone' => $request->time_zone
        ]
      );

      toastr('Updated Successfully!');

      return redirect()->back();

    }

    public function getCurrencySymbol(Request $request) {

      $symbol = Currencies::getSymbol($request->currencyCode);

      return $symbol;
    }

}
