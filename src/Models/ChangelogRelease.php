<?php

namespace E98Developer\LaravelChangelogManagerPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChangelogRelease extends Model
{
    protected $fillable=['name','description','version','released'];

    public function changelog(): HasMany
    {
        return $this->hasMany(Changelog::class);
    }
}
