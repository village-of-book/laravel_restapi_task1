<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class PostFactory extends Factory
{
  protected $model = Post::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'user_id' => User::factory(), // UserモデルのFactoryを使用してユーザを生成
      'post' => $this->faker->text(200) // ダミーのテキストデータ
    ];
  }
}