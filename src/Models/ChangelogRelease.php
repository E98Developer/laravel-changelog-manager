<?php

namespace E98Developer\LaravelChangelogManagerPackage\Models;

use Illuminate\Database\Eloquent\Model;

class ChangelogRelease extends Model
{
    protected $fillable=['name','description','version','released'];

}
