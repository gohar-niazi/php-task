<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);


Route::get('/external-posts', function () {
    $response = Http::withoutVerifying()->get('https://jsonplaceholder.typicode.com/posts');

    $posts = collect($response->json())
        ->take(10)
        ->map(function ($post) {
            return [
                'title' => $post['title'],
                'body' => $post['body']
            ];
        });

    return response()->json($posts);
});



Route::get('/scrape-quotes', function () {
    $html = file_get_contents('http://quotes.toscrape.com/');

    preg_match_all('/<span class="text" itemprop="text">(.*?)<\/span>.*?<small class="author" itemprop="author">(.*?)<\/small>/s', $html, $matches);

    $quotes = [];

    foreach ($matches[1] as $index => $quote) {
        $quotes[] = [
            'quote' => strip_tags($quote),
            'author' => $matches[2][$index]
        ];
    }

    return response()->json($quotes);
});

Route::get('/custom-request', function () {
    $response = Http::withoutVerifying()->withHeaders([
        'User-Agent' => 'MyApp/1.0',
        'Accept' => 'application/json'
    ])->get('https://jsonplaceholder.typicode.com/posts/1');

    return response()->json([
        'status' => $response->status(),
        'data' => $response->json()
    ]);
});
