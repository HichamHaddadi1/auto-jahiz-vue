<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Admin/Settings/Index');
    }

    public function account(): \Inertia\Response
    {
        $record = Account::with('devise', 'language', 'notificationLanguage')
            ->where('user_id', auth()->user()->id)->first() ?? [];
        return Inertia::render('Admin/Settings/Account/Account', [
            'account' => $record,
        ]);
    }

    public function emailTemplates(): \Inertia\Response
    {
        return Inertia::render('Admin/Settings/EmailTemplates');
    }

    public function activityLogs(): \Inertia\Response
    {
        return Inertia::render('Admin/Settings/ActivityLogs');
    }

    public function rolesPermissions(): \Inertia\Response
    {
        return Inertia::render('Admin/Settings/RolesPermissions');
    }
}
