<?php

namespace E98Developer\LaravelChangelogManagerPackage\Commands;

use E98Developer\LaravelChangelogManagerPackage\Enums\ChangelogTypeEnum;
use E98Developer\LaravelChangelogManagerPackage\Models\Changelog;
use E98Developer\LaravelChangelogManagerPackage\Models\ChangelogRelease;
use Illuminate\Console\Command;
use function Laravel\Prompts\form;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class ChangelogAddCommand extends Command
{
    protected $signature = 'changelog:add';

    protected $description = 'Add new changelog for release';

    public function handle(): void
    {


        $release=ChangelogRelease::whereNull('released')
            ->select(['name','id','version'])
            ->orderBy('id')
            ->get();
        if($release->count()>1){
            $releaseOptions=[];
            $release->each(function ($item, $key) use (&$releaseOptions) {
                $releaseOptions[]=$item->name.' -> '.$item->version;
            });
            $selectedRelease = select(
                label: 'Which release would you like to add it to?',
                options:$releaseOptions,
                default: 0
            );
            $actRelease=$release->where('version',explode(' -> ', $selectedRelease)[1])->first();
        }else{
            $actRelease=$release->first();
        }

        $response=form()
         ->select(
            label: 'What type?',
            options:array_column(ChangelogTypeEnum::cases(), 'value'),
            default: 0,
            name: 'type',
        )
        ->text(
            label: 'Description text?',
            placeholder: 'Changelog description',
            name: 'description',
            default: 'asd asd sd'
        )
        ->submit();

        $Changelog=new Changelog();
        $Changelog->fill($response);
        $Changelog->changelogRelease()->associate($actRelease);
        $Changelog->save();
        $this->info('Changelog added to '.$actRelease->name.'!');

    }
}
