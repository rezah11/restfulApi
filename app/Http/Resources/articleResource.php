<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class articleResource extends JsonResource
{
    public $with=[

    ];
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|/JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
//        dd($this->when($request->with==='user',$this->users),$request->with);
//        $routePrefix=$request->segments()[1] ?? null;
//            dd($request->segments()[1]);
//       $this->load('users');
//            dd($this->whenLoaded('users','bale','na'));
//dd($this->load('users'));
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
//            'user'=>$this->when($request->with==='user',new UserResource($this->users)),
//            'user'=>$this->when($routePrefix==='article',new UserResource($this->users),new MissingValue),
//            'user' => new UserResource($this->users),
            'user' => $this->whenLoaded('users',function () use ($request){
//                dd($request->with==='users');
                return $request->with==='users' ? new UserResource($this->users) : new MissingValue();}),

        ];

    }
}
