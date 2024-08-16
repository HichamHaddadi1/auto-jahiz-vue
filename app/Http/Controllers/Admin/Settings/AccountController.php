<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function updateAccount(Request $request)
    {
        $account = Account::where('user_id', auth()->user()->id)->first();

        if (!$account) {
            $account = Account::create(
                [
                    'id' => Str::uuid(),
                    'user_id' => auth()->user()->id,
                    "social_reason" =>  $request->social_reason ?? null,
                    "email" =>  $request->email ?? null,
                    "last_bill_number" =>  $request->last_bill_number ?? 0,
                    "currency_id" => $request->currency_id ?? null,
                    "language_id" =>  $request->language_id ?? null,
                    "notification_language_id" =>  $request->notification_language_id ?? null,
                    "tva" =>  $request->tva ?? 0,
                    "visite_alert" =>  $request->visite_alert ?? 0,
                    "insurances_alert" =>  $request->insurances_alert  ?? 0,
                    "permissions_alert" =>  $request->permissions_alert ?? 0,
                    "oil_change_alert" =>  $request->oil_change_alert ?? 0,
                    "footers" => $request->footers ?? null,
                    "theme" => $request->theme ?? null,

                ]
            );
        } else {
            $account->update($request->except(['logo', 'favicon']));
        }
        if ($request->hasFile('logo')) {
            //validate the file before upload
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('logo');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('accounts/' . $account->id . '/logo', $fileName, 's3');
            $path = $file->storeAs('accounts/' . $account->id . '/logo', $fileName, 's3');
            $account->update(['logo' => $path]);
        }

        if ($request->hasFile('favicon')) {
            //validate the file before upload
            $request->validate([
                'favicon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('favicon');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('accounts/' . $account->id . '/favicon', $fileName, 's3');
            $path = $file->storeAs('accounts/' . $account->id . '/favicon', $fileName, 's3');
            $account->update(['favicon' => $path]);
        }

        return redirect()->back()->with('success');
    }

    public function fetchCurrencies(): JsonResponse
    {
        $currencies = Currency::orderBy('name', 'asc')->get();
        return response()->json($currencies);
    }

    public function fetchLanguages(): JsonResponse
    {
        $languages = Language::orderBy('name', 'asc')->get();
        return response()->json($languages);
    }
}
