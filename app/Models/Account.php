<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'accounts';

    protected $fillable = [
        'id',
        'user_id',
        'currency_id',
        'is_active',
        'tva',
        'last_bill_number',
        'last_quote_number',
        'visite_alert',
        'insurances_alert',
        'permissions_alert',
        'oil_change_alert',
        'expiration_date',
        'social_reason',
        'max_reservations',
        'max_clients',
        'max_vehicles',
        'signature',
        'logo',
        'favicon',
        'email',
        'prefix_bill',
        'prefix_contract',
        'web_modal',
        'last_access',
        'language_id',
        'notification_language_id',
        'footers',
        'files_max_sizes',
        'theme',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tva' => 'decimal:5',
        'expiration_date' => 'date',
        'max_reservations' => 'integer',
        'max_clients' => 'integer',
        'max_vehicles' => 'integer',
        'last_access' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function devise()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function notificationLanguage()
    {
        return $this->belongsTo(Language::class, 'notification_language_id', 'id');
    }
}
