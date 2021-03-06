<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->slug(4),
            'title' => $this->faker->sentence(2, true),
            'annotation' => $this->faker->words(3, true),
            'body' => $this->faker->paragraph(20),
            'published' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => User::factory(),

        ];
    }
}
