<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class userResourceCollection extends ResourceCollection
{
//    public $collects = UserResource::class;
//    public $with = ['data' => ['name' => 'sebastian']];

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|/JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);

    }
public function with($request)
{
    return parent::with($request); // TODO: Change the autogenerated stub
}
//    public function with($request)
//    {
////        dd($request->articles);
////        return ['articles'=>];
//       }
}