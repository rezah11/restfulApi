<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('wba:foo', function () {
    echo 'salam foo';
})->describe('this is foo test');

//Artisan::command('salam {name=reza} {family=azami} ', function ($name , $family) {
//    echo 'salam be ', $name,',',$family, ' az artisan';
//});
Artisan::command('wba:salam {name=reza : person name} {family=azami : } ', function ($name , $family) {
    echo 'salam be ', $name,',',$family, ' az artisan';
});
Artisan::command('wba:day {dayNumber}', function ($dayNumber) {
    switch ($dayNumber){
        case 1: echo 'shanbe';break;
        case 2: echo '1 shanbe';break;
        case 3: echo '2 shanbe';break;
        case 4: echo '3 shanbe';break;
        case 5: echo '4 shanbe';break;
        case 6: echo '5 shanbe';break;
        case 7: echo 'jome';break;
        default: echo 'na moshakhas';
    }
})->describe('with insert number get day');

Artisan::command('wba:sum  {label : this is label of sum} {numbers* : number of calculate}', function ($label,$numbers) {
    $res=array_sum($numbers);
    echo $label,': ',$res;
});
Artisan::command('wba:print {name : person Name}{--wrap : wrap name with something}{--label : add label to output }',function ($name){
    /** @var Illuminate\Foundation\Console\ClosureCommand $this */
    dd($this->option('wrap'));
//    $wrapper=$this->option('wrap') ? "'" : "";
    $wrapper=$this->option('wrap');
    $label=$this->option('label') ? 'name is: ' : "";
    echo $label,$wrapper,$name,$wrapper;
})->describe('single quotation added');
