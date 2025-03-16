<?php

namespace E98Developer\LaravelChangelogManagerPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Changelog extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at','deleted_at'];

    public function changelogRelease(): BelongsTo
    {
        return $this->belongsTo(ChangelogRelease::class);
    }
}
