<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

Route::group(
    'api',
    function () {
        Route::group('user', function () {
            Route::post('list','User/getList');
            Route::get('info/:id','User/getInfo');
        });

        Route::group('music', function () {
            Route::post('list','Music/getList');
            Route::get('info/:id','Music/getInfo');
        });

        Route::group('video', function () {
            Route::post('list','Video/getList');
            Route::get('info/:id','Video/getInfo');
        });

        Route::group('article', function () {
            Route::post('list','Article/getList');
            Route::get('info/:id','Article/getInfo');
        });

        Route::group('recommend', function () {
            Route::post('list','Recommend/getList');
        });
    }
);