<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::post('product-tags/media', 'ProductTagController@storeMedia')->name('product-tags.storeMedia');
    Route::post('product-tags/ckmedia', 'ProductTagController@storeCKEditorImages')->name('product-tags.storeCKEditorImages');
    Route::resource('product-tags', 'ProductTagController');

    // Product

    Route::get('products/check_slug', 'ProductController@checkSlug')->name('products.checkSlug');
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Best Sellers
    Route::delete('best-sellers/destroy', 'BestSellersController@massDestroy')->name('best-sellers.massDestroy');
    Route::resource('best-sellers', 'BestSellersController');

    // Featured Product
    Route::delete('featured-products/destroy', 'FeaturedProductController@massDestroy')->name('featured-products.massDestroy');
    Route::resource('featured-products', 'FeaturedProductController');

    // Spesial Offers
    Route::delete('spesial-offers/destroy', 'SpesialOffersController@massDestroy')->name('spesial-offers.massDestroy');
    Route::resource('spesial-offers', 'SpesialOffersController');

    // News Category
    Route::delete('news-categories/destroy', 'NewsCategoryController@massDestroy')->name('news-categories.massDestroy');
    Route::post('news-categories/media', 'NewsCategoryController@storeMedia')->name('news-categories.storeMedia');
    Route::post('news-categories/ckmedia', 'NewsCategoryController@storeCKEditorImages')->name('news-categories.storeCKEditorImages');
    Route::resource('news-categories', 'NewsCategoryController');

    // News Tags
    Route::delete('news-tags/destroy', 'NewsTagsController@massDestroy')->name('news-tags.massDestroy');
    Route::post('news-tags/media', 'NewsTagsController@storeMedia')->name('news-tags.storeMedia');
    Route::post('news-tags/ckmedia', 'NewsTagsController@storeCKEditorImages')->name('news-tags.storeCKEditorImages');
    Route::resource('news-tags', 'NewsTagsController');

    // News
    Route::delete('newss/destroy', 'NewsController@massDestroy')->name('newss.massDestroy');
    Route::post('newss/media', 'NewsController@storeMedia')->name('newss.storeMedia');
    Route::post('newss/ckmedia', 'NewsController@storeCKEditorImages')->name('newss.storeCKEditorImages');
    Route::resource('newss', 'NewsController');

    // Fludgy Flavors
    Route::delete('fludgy-flavors/destroy', 'FludgyFlavorsController@massDestroy')->name('fludgy-flavors.massDestroy');
    Route::resource('fludgy-flavors', 'FludgyFlavorsController');

    // Personalized One
    Route::delete('personalized-ones/destroy', 'PersonalizedOneController@massDestroy')->name('personalized-ones.massDestroy');
    Route::post('personalized-ones/media', 'PersonalizedOneController@storeMedia')->name('personalized-ones.storeMedia');
    Route::post('personalized-ones/ckmedia', 'PersonalizedOneController@storeCKEditorImages')->name('personalized-ones.storeCKEditorImages');
    Route::resource('personalized-ones', 'PersonalizedOneController');

    // Personalized Two
    Route::delete('personalized-twos/destroy', 'PersonalizedTwoController@massDestroy')->name('personalized-twos.massDestroy');
    Route::post('personalized-twos/media', 'PersonalizedTwoController@storeMedia')->name('personalized-twos.storeMedia');
    Route::post('personalized-twos/ckmedia', 'PersonalizedTwoController@storeCKEditorImages')->name('personalized-twos.storeCKEditorImages');
    Route::resource('personalized-twos', 'PersonalizedTwoController');

    // Personalized Tree
    Route::delete('personalized-trees/destroy', 'PersonalizedTreeController@massDestroy')->name('personalized-trees.massDestroy');
    Route::post('personalized-trees/media', 'PersonalizedTreeController@storeMedia')->name('personalized-trees.storeMedia');
    Route::post('personalized-trees/ckmedia', 'PersonalizedTreeController@storeCKEditorImages')->name('personalized-trees.storeCKEditorImages');
    Route::resource('personalized-trees', 'PersonalizedTreeController');

    // Product Banner One
    Route::delete('product-banner-ones/destroy', 'ProductBannerOneController@massDestroy')->name('product-banner-ones.massDestroy');
    Route::post('product-banner-ones/media', 'ProductBannerOneController@storeMedia')->name('product-banner-ones.storeMedia');
    Route::post('product-banner-ones/ckmedia', 'ProductBannerOneController@storeCKEditorImages')->name('product-banner-ones.storeCKEditorImages');
    Route::resource('product-banner-ones', 'ProductBannerOneController');

    // Product Banner Two
    Route::delete('product-banner-twos/destroy', 'ProductBannerTwoController@massDestroy')->name('product-banner-twos.massDestroy');
    Route::post('product-banner-twos/media', 'ProductBannerTwoController@storeMedia')->name('product-banner-twos.storeMedia');
    Route::post('product-banner-twos/ckmedia', 'ProductBannerTwoController@storeCKEditorImages')->name('product-banner-twos.storeCKEditorImages');
    Route::resource('product-banner-twos', 'ProductBannerTwoController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/media', 'ClientsController@storeMedia')->name('clients.storeMedia');
    Route::post('clients/ckmedia', 'ClientsController@storeCKEditorImages')->name('clients.storeCKEditorImages');
    Route::resource('clients', 'ClientsController');

    // About Image
    Route::delete('about-images/destroy', 'AboutImageController@massDestroy')->name('about-images.massDestroy');
    Route::post('about-images/media', 'AboutImageController@storeMedia')->name('about-images.storeMedia');
    Route::post('about-images/ckmedia', 'AboutImageController@storeCKEditorImages')->name('about-images.storeCKEditorImages');
    Route::resource('about-images', 'AboutImageController');

    // What We Have
    Route::delete('what-we-haves/destroy', 'WhatWeHaveController@massDestroy')->name('what-we-haves.massDestroy');
    Route::resource('what-we-haves', 'WhatWeHaveController');

    // Social Media
    Route::delete('social-media/destroy', 'SocialMediaController@massDestroy')->name('social-media.massDestroy');
    Route::resource('social-media', 'SocialMediaController');

    // Setting Content
    Route::delete('setting-contents/destroy', 'SettingContentController@massDestroy')->name('setting-contents.massDestroy');
    Route::post('setting-contents/media', 'SettingContentController@storeMedia')->name('setting-contents.storeMedia');
    Route::post('setting-contents/ckmedia', 'SettingContentController@storeCKEditorImages')->name('setting-contents.storeCKEditorImages');
    Route::resource('setting-contents', 'SettingContentController');

    // Orders
    Route::delete('orders/destroy', 'OrdersController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrdersController');

    // Order Details
    Route::delete('order-details/destroy', 'OrderDetailsController@massDestroy')->name('order-details.massDestroy');
    Route::resource('order-details', 'OrderDetailsController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
