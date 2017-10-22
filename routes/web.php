<?php

Route::post('/crawl', ['uses' => 'CrawlerController'])->name('crawl');
Auth::routes();

Route::get('/{vue_capture?}', [
    'as' => 'vue.index',
    'uses' => 'HomeController@index'
])->where('vue_capture', '[\/\w\.-]*');