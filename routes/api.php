<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Frontend'], function () {
    // Product Category
    Route::apiResource('product-categories', 'ProductCategoryApiController', ['only' => ['index', 'show']]);

    // Product Tag
    Route::apiResource('product-tags', 'ProductTagApiController', ['only' => ['index', 'show']]);

    // Product
    Route::apiResource('products', 'ProductApiController', ['only' => ['index', 'show']]);

    // Best Sellers
    Route::apiResource('best-sellers', 'BestSellersApiController', ['only' => ['index', 'show']]);

    // Featured Product
    Route::apiResource('featured-products', 'FeaturedProductApiController', ['only' => ['index', 'show']]);

    // Spesial Offers
    Route::apiResource('spesial-offers', 'SpesialOffersApiController', ['only' => ['index', 'show']]);

    // News Category
    Route::apiResource('news-categories', 'NewsCategoryApiController', ['only' => ['index', 'show']]);

    // News Tags
    Route::apiResource('news-tags', 'NewsTagsApiController', ['only' => ['index', 'show']]);

    // Fludgy Flavors
    Route::apiResource('fludgy-flavors', 'FludgyFlavorsApiController', ['only' => ['index', 'show']]);

    // Personalized One
    Route::apiResource('personalized-ones', 'PersonalizedOneApiController', ['only' => ['index', 'show']]);

    // Personalized Two
    Route::apiResource('personalized-twos', 'PersonalizedTwoApiController', ['only' => ['index', 'show']]);

    // Personalized Tree
    Route::apiResource('personalized-trees', 'PersonalizedTreeApiController', ['only' => ['index', 'show']]);

    // Product Banner One
    Route::apiResource('product-banner-ones', 'ProductBannerOneApiController', ['only' => ['index', 'show']]);

    // Product Banner Two
    Route::apiResource('product-banner-twos', 'ProductBannerTwoApiController', ['only' => ['index', 'show']]);

    // Clients
    Route::apiResource('clients', 'ClientsApiController', ['only' => ['index', 'show']]);

    // About Image
    Route::apiResource('about-images', 'AboutImageApiController', ['only' => ['index', 'show']]);

    // What We Have
    Route::apiResource('what-we-haves', 'WhatWeHaveApiController', ['only' => ['index', 'show']]);

    // Social Media
    Route::apiResource('social-media', 'SocialMediaApiController', ['only' => ['index', 'show']]);

    // Setting Content
    Route::apiResource('setting-contents', 'SettingContentApiController', ['only' => ['index', 'show']]);

    // Orders
    Route::apiResource('orders', 'OrdersApiController', ['only' => ['index', 'show']]);

    // Order Details
    Route::apiResource('order-details', 'OrderDetailsApiController', ['only' => ['index', 'show']]);
});
