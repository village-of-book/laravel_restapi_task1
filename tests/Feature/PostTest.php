<?php
use App\Models\Post;
use App\Models\User;

// it('has post page', function () {
//     $response = $this->get('/post');

//     $response->assertStatus(200);
// });

it('displays posts', function () {
    // ユーザを作成
    $user = User::factory()->create();
  
    // ユーザを認証
    $this->actingAs($user);
  
    // Tweetを作成
    $post = Post::factory()->create();
  
    // GETリクエスト
    $response = $this->get('/post');
  
    // レスポンスにTweetの内容と投稿者名が含まれていることを確認
    $response->assertStatus(200);
    $response->assertSee($post->post);
    $response->assertSee($post->user->name);
  });

  // 作成画面のテスト
it('displays the create post page', function () {
    // テスト用のユーザーを作成
    $user = User::factory()->create();
  
    // ユーザーを認証（ログイン）
    $this->actingAs($user);
  
    // 作成画面にアクセス
    $response = $this->get('/post/create');
  
    // ステータスコードが200であることを確認
    $response->assertStatus(200);
  });

  // 作成処理のテスト
it('allows authenticated users to create a post', function () {
    // ユーザを作成
    $user = User::factory()->create();
  
    // ユーザを認証
    $this->actingAs($user);
  
    // Tweetを作成
    $tweetData = ['post' => 'This is a test post.'];
  
    // POSTリクエスト
    $response = $this->post('/post', $tweetData);
  
    // データベースに保存されたことを確認
    $this->assertDatabaseHas('post', $tweetData);
  
    // レスポンスの確認
    $response->assertStatus(302);
    $response->assertRedirect('/post');
  });

  // 詳細画面のテスト
it('displays a post', function () {
    // ユーザを作成
    $user = User::factory()->create();
  
    // ユーザを認証
    $this->actingAs($user);
  
    // Tweetを作成
    $post = Tweet::factory()->create();
  
    // GETリクエスト
    $response = $this->get("/post/{$post->id}");
  
    // レスポンスにTweetの内容が含まれていることを確認
    $response->assertStatus(200);
    $response->assertSee($post->post);
    $response->assertSee($post->created_at->format('Y-m-d H:i'));
    $response->assertSee($post->updated_at->format('Y-m-d H:i'));
    $response->assertSee($post->post);
    $response->assertSee($post->user->name);
  });

  // 編集画面のテスト
it('displays the edit post page', function () {
    // テスト用のユーザーを作成
    $post = User::factory()->create();
  
    // ユーザーを認証（ログイン）
    $this->actingAs($post);
  
    // Tweetを作成
    $post = Post::factory()->create(['user_id' => $user->id]);
  
    // 編集画面にアクセス
    $response = $this->get("/post/{$post->id}/edit");
  
    // ステータスコードが200であることを確認
    $response->assertStatus(200);
  
    // ビューにTweetの内容が含まれていることを確認
    $response->assertSee($post->post);
  });
  
  // 更新処理のテスト
it('allows a user to update their post', function () {
    // ユーザを作成
    $user = User::factory()->create();
  
    // ユーザを認証
    $this->actingAs($user);
  
    // Tweetを作成
    $post = Post::factory()->create(['user_id' => $user->id]);
  
    // 更新データ
    $updatedData = ['post' => 'Updated post content.'];
  
    // PUTリクエスト
    $response = $this->put("/post/{$post->id}", $updatedData);
  
    // データベースが更新されたことを確認
    $this->assertDatabaseHas('post', $updatedData);
  
    // レスポンスの確認
    $response->assertStatus(302);
    $response->assertRedirect("/post/{$tweet->id}");
  });

  // 削除処理のテスト
it('allows a user to delete their post', function () {
    // ユーザを作成
    $user = User::factory()->create();
  
    // ユーザを認証
    $this->actingAs($user);
  
    // Tweetを作成
    $post = Post::factory()->create(['user_id' => $user->id]);
  
    // DELETEリクエスト
    $response = $this->delete("/post/{$tweet->id}");
  
    // データベースから削除されたことを確認
    $this->assertDatabaseMissing('post', ['id' => $tweet->id]);
  
    // レスポンスの確認
    $response->assertStatus(302);
    $response->assertRedirect('/post');
  });