<?php

namespace E98Developer\LaravelChangelogManagerPackage\Commands;

use Carbon\Carbon;
use E98Developer\LaravelChangelogManagerPackage\Models\ChangelogRelease;
use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\multiselect;

class ChangelogReleaseCommand extends Command
{
    protected $signature = 'changelog:release';

    protected $description = 'Release selected version.';

    public function handle(): void
    {
        $release=ChangelogRelease::whereNull('released')
            ->select(['name','id','version'])
            ->orderBy('id')
            ->get();
        $releaseOptions=[];
        $release->each(function ($item, $key) use (&$releaseOptions) {
            $releaseOptions[]=$item->name.' -> '.$item->version;
        });
        $selectedRelease = select(
            label: 'What should the release?',
            options:$releaseOptions,
            default: 0
        );
        $actRelease=$release->where('version',explode(' -> ', $selectedRelease)[1])->first();
        \Storage::write('version',$actRelease->version);
        $actRelease->released=Carbon::now();
        $actRelease->save();
        $this->info('Released '.$selectedRelease);
    }
}
