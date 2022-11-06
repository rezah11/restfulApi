<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class articleResourceCollection extends ResourceCollection
{

//    static $wrap='attr';
public $with=[
    'data'=>'0'
];
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'attr'=>parent::toArray($request),
//          static::$wrap=>'attr',
          'foo'=>'bar'
        ];
    }
}
