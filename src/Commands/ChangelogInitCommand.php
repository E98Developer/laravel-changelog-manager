<?php

namespace E98Developer\LaravelChangelogManagerPackage\Commands;

use Carbon\Carbon;
use E98Developer\LaravelChangelogManagerPackage\Models\ChangelogRelease;
use Illuminate\Console\Command;
use function Laravel\Prompts\form;
use function Laravel\Prompts\text;

class ChangelogInitCommand extends Command
{
    protected $signature = 'changelog:init';

    protected $description = 'Init changelog and version.';

    public function handle(): int
    {
        $response=form()
            ->text(
                label: 'Release name?',
                default: 'Init',
                name: 'name'
            )
            ->confirm(
                label: 'Do you want add description?',
                default: false,
                name: 'setDescription'
            )
            ->add(function ($response){
                if($response['setDescription']){
                    return text(
                        label: 'Description text?',
                        placeholder: 'Changelog description',
                    );

                }

            },'description')
            ->text(
                label: 'Initial version number?',
                placeholder: 'Changelog description',
                default: '0.1.0',
                name: 'version'
            )
            ->confirm(
                label: 'Do you want set released?',
                default: false,
                name: 'setReleased'
            )
            ->add(function ($response){
                if($response['setReleased']){
                    return text(
                        label: 'Released date?',
                        placeholder: 'Changelog Release date',
                        default: Carbon::now()->toDateTimeString(),
                    );

                }

            },'released')
            ->submit();

        // TODO: need validation
        $Release=new ChangelogRelease();
        $Release->name=$response['name'];
        $Release->description=$response['description'];
        $Release->released=$response['released'];
        $Release->version=$response['version'];
        $Release->save();

        if($response['setReleased']){
            // TODO:need release flow
        }
        $this->info($response['version'].' version release inited');
        return Command::SUCCESS;
    }
}
