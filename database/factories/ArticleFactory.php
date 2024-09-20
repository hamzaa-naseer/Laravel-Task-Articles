<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titleLengthRange = range(3,7);
        $titleLengthRangeKey = array_rand($titleLengthRange);
        $titleLength = $titleLengthRange[$titleLengthRangeKey];

        $categories = [
            'News',
            'Politics',
            'Sports',
            'Science',
            'Technology',
            'Health'
        ];
        $categoriesRangeKey = array_rand($categories);
        $category = $categories[$categoriesRangeKey];

        $tagOptions = [
            'music',
            'max burn',
            'aerospace',
            'crypto',
            'hydration',
            'agile'
        ];

        $tagsKeys = array_rand($tagOptions, 3);

        $tags = [];

        foreach($tagOptions as $tagOptionIndex => $tagOptionValue) {

            if(in_array($tagOptionIndex, $tagsKeys)) {

               $tags[]= $tagOptionValue; 
            }

        }

        return [
            'title' => rtrim(fake()->sentence($titleLength),'.'),
            'body' => fake()->text(300),
            'category' => $category,
            'tags' => json_encode($tags),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
