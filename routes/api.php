<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/post/comments', 'api\PostCommentsController@showAllComments')->name('allComments');
Route::post('/post/comment/create', 'api\PostCommentsController@commentCreate')->name('commentCreate');
/*Route::post('/post/comment/edit', 'api\PostCommentsController@commentEdit')->name('commentEdit');*/
Route::put('/post/comment/update', 'api\PostCommentsController@commentUpdate')->name('commentUpdate');
Route::delete('/post/comment/delete', 'api\PostCommentsController@commentDelete')->name('commentDelete');

