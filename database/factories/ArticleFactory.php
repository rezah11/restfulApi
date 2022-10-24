<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds=User::query()->pluck('id')->toArray();
//        dd($userIds,);
        return [
            //
//           '' $this->faker->email()
        'user_id'=>$userIds[random_int(0,19)],
        'title'=>$this->faker->title(),
        'body'=>$this->faker->text(100),
        ];
    }
}
