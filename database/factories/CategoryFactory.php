<?php

use Faker\Generator as Faker;
use App\Models\Category;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement([Category::TYPE_POST, Category::TYPE_PAGE, Category::TYPE_LINK]),
        'parent_id' => 0,
        'cate_name' => $faker->word,
        'description' => $faker->text(200),
        'url' => function (array $category) use ($faker) {
            switch ($category) {
                case Category::TYPE_LINK:
                    return $faker->url;
                    break;
                default:
                    return null;
                    break;
            }
        },
        'cate_slug' => function (array $category) use ($faker) {
            switch ($category) {
                case Category::TYPE_LINK:
                    return $faker->unique()->slug;
                    break;
                default:
                    return null;
                    break;
            }
        },

        'is_target_blank' => function (array $category) use ($faker) {
            switch ($category) {
                case Category::TYPE_LINK:
                    return $faker->boolean;
                    break;
                default:
                    return true;
                    break;
            }
        },
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
        'is_nav' => $faker->boolean,
        'order' => $faker->randomDigitNotNull,
        'list_template' => function (array $category) {
            switch ($category['type']) {
                case Category::TYPE_POST:
                    return 'post.index';
                    break;
                case Category::TYPE_PAGE:
                    return 'post.page';
                    break;
                default:
                    return null;
                    break;
            }
        },

        'content_template' => function (array $category) {
            switch ($category['type']) {
                case Category::TYPE_POST:
                    return 'post.content';
                    break;
                default:
                    return null;
                    break;
            }
        },


    ];
});