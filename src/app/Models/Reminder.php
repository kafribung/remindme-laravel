<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Reminder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function epochToDate($epoch)
    {
        return Carbon::createFromTimestamp($epoch)->toDateTimeString();
    }

    // public function scopeRemindersAfterNow(Builder $query)
    // {
    //     $query->whereRaw('epochToDate(remind_at) >= now()');
    // }

    public function getRemindersAfterNow()
    {
        return $this->whereRaw('epochToDate(remind_at) >= now()')->get();
        // return $this->whereRaw('epochToDate(remind_at) >= now()');
    }
}
