<?php


Route::prefix('auth')->group(function () {

    Route::get('login', function () {

        return view('backend.auth.login');

    })->name('login');

    Route::post('login', 'AuthController@login')->name('post.login');
    Route::get('logout', 'AuthController@logout')->name('get.logout');

    Route::get('request-password-reset', function () {

        return view('backend.auth.request-password-reset');

    })->name('get.request-reset-password');

    Route::post('request-password-reset', 'AuthController@requestPasswordReset')->name('post.request-reset-password');

    Route::get('password-reset', function () {

        return view('backend.auth.password-reset');

    })->middleware('signed')->name('get.reset-password');

    Route::post('password-reset', 'AuthController@passwordReset')->name('post.reset-password');

});

Route::middleware('auth:admin')->group(function () {

    Route::get('', function () {

        return view('backend.dashboard');

    })->name('get.dashboard');

    Route::prefix('admins')->group(function () {

        Route::get('', function () {

            \Illuminate\Support\Facades\Redirect::route('get.admin-users');

        });

        Route::prefix('users')->group(function () {

            Route::get('', 'AdminController@users')->name('get.admin-users')->middleware('can:admins.user.read');
            Route::get('create', 'AdminController@getCreate')->name('get.admin-user-create')->middleware('can:admins.user.create');
            Route::get('{admin}', 'AdminController@user')->name('get.admin-user')->middleware('can:admins.user.edit');

            Route::post('', 'AdminController@create')->name('post.create-admin')->middleware('can:admins.user.create');
            Route::post('{admin}', 'AdminController@update')->name('post.update-admin')->middleware('can:admins.user.edit');

            Route::get('{admin}/delete', 'AdminController@softDelete')->name('get.delete-admin')->middleware('can:admins.user.delete');

        });

        Route::prefix('groups')->group(function () {

            Route::get('', 'AdminGroupController@groups')->name('get.admin-groups')->middleware('can:admins.group.read');
            Route::get('create', 'AdminGroupController@getCreate')->name('get.admin-group-create')->middleware('can:admins.group.create');
            Route::get('{group}', 'AdminGroupController@group')->name('get.admin-group')->middleware('can:admins.group.edit');

            Route::post('', 'AdminGroupController@create')->name('post.create-admin-group')->middleware('can:admins.group.create');
            Route::post('{group}', 'AdminGroupController@update')->name('post.update-admin-group')->middleware('can:admins.group.edit');

            Route::get('{group}/logo', 'AdminGroupController@getLogo')->name('get.admin-group-logo');

        });

        Route::prefix('roles')->group(function () {

            Route::get('', 'AdminRolesController@roles')->name('get.admin-roles')->middleware('can:admins.role.read');
            Route::get('create', 'AdminRolesController@getCreate')->name('get.admin-role-create')->middleware('can:admins.role.create');
            Route::get('{role}', 'AdminRolesController@role')->name('get.admin-role')->middleware('can:admins.role.edit');

            Route::post('', 'AdminRolesController@create')->name('post.create-admin-role')->middleware('can:admins.role.create');
            Route::post('{role}', 'AdminRolesController@update')->name('post.update-admin-role')->middleware('can:admins.role.edit');

        });

    });

    Route::prefix('app-users')->group(function () {

        Route::prefix('users')->group(function () {

            Route::get('', 'AppUsersController@users')->name('get.app-users')->middleware('can:app-user.read');
            Route::get('create', 'AppUsersController@getcreate')->name('get.app-user-create')->middleware('can:app-user.create');
            Route::get('{user}', 'AppUsersController@user')->name('get.app-user')->middleware('can:app-user.edit');

            Route::post('', 'AppUsersController@createUser')->name('post.create-app-user')->middleware('can:app-user.create');


            Route::post('{user}', 'AppUsersController@updateUser')->name('post.update-app-user')->middleware('can:app-user.edit');
            Route::post('{user}/profile', 'AppUsersController@createPorfile')->name('post.create-app-user-profile')->middleware('can:app-user.edit');
            Route::post('{user}/profile/{profile}', 'AppUsersController@updateProfile')->name('post.update-app-user-profile')->middleware('can:app-user.edit');

            Route::get('{user}/delete', 'AppUsersController@softDelete')->name('get.delete-app-user')->middleware('can:app-user.delete');
        });

    });

    Route::prefix('newsletter')->group(function () {

        Route::get('', 'NewsletterController@newsletters')->name('get.newsletters')->middleware('can:newsletter.read');
        Route::get('/create', 'NewsletterController@getCreate')->name('get.newsletter-create')->middleware('can:newsletter.create');
        Route::post('create', 'NewsletterController@create')->name('post.newsletter-create')->middleware('can:newsletter.create');
        Route::get('{newsletter}', 'NewsletterController@newsletter')->name('get.newsletter')->middleware('can:newsletter.edit');
        Route::post('{newsletter}', 'NewsletterController@update')->name('post.newsletter-update')->middleware('can:newsletter.edit');
        Route::get('{newsletter}/send', 'NewsletterController@send')->name('get.newsletter-send')->middleware('can:newsletter.send');
        Route::get('{newsletter}/delete', 'NewsletterController@delete')->name('get.newsletter-delete')->middleware('can:newsletter.delete');


    });

    Route::prefix('scata')->group(function () {

        Route::get('products/{category?}', 'Scata\ProductController@products')->name('get.scata.products');

        Route::get('product/{product}', 'Scata\ProductController@product')->name('get.scata.product');
        Route::post('product/{product}', 'Scata\ProductController@update')->name('post.scata.product-update');
        Route::get('product/ocr/{image}', 'Scata\ProductController@ocr')->name('get.scata.product.start-ocr');
        Route::post('product/image/{product}/{type}/edit', 'Scata\ProductController@editImage')->name('post.scata.product-image-edit');

        Route::get('ingredients/{category?}', 'Scata\IngredientController@ingredients')->name('get.scata.ingredients');
        Route::get('ingredient/{ingredient}', 'Scata\IngredientController@ingredient')->name('get.scata.ingredient');
        Route::post('ingredient/{ingredient}', 'Scata\IngredientController@update')->name('post.scata.ingredient-update');

        Route::get('producers', 'Scata\ProducerController@producers')->name('get.scata.producers');
        Route::get('create-producer', 'Scata\ProducerController@getCreate')->name('get.scata.producer-create');
        Route::post('create-producer', 'Scata\ProducerController@create')->name('post.scata.producer-create');
        Route::get('producer/{producer}', 'Scata\ProducerController@producer')->name('get.scata.producer');
        Route::post('producer/{producer}', 'Scata\ProducerController@update')->name('post.scata.producer-update');

        Route::get('qualities', 'Scata\QualityController@qualities')->name('get.scata.qualities');
        Route::get('create-quality', 'Scata\QualityController@getCreate')->name('get.scata.quality-create');
        Route::post('create-quality', 'Scata\QualityController@create')->name('post.scata.quality-create');
        Route::get('quality/{quality}', 'Scata\QualityController@quality')->name('get.scata.quality');
        Route::post('quality/{qualitySeal}', 'Scata\QualityController@update')->name('post.scata.quality-update');

        Route::get('clean-products', function() {

            $products = \App\Models\Scata\Products\Product::all();

            foreach ($products as $product) {

                if ($product->status == 'inactive' || $product->status == 'creating') {

                    echo $product->name;



                    $product->eans()->delete();
                    $product->images()->delete();
                    $product->producer()->detach();
                    $product->ingredients()->detach();
                    $product->qualitySeals()->detach();
                    $product->delete();


                }

            }

            foreach (App\Models\Scata\Products\Product::onlyTrashed()->get() as $trashed) {

                $nutrientGroups = \App\Models\Scata\Nutrients\NutrientGroup::where('product_id', $trashed->product_id)->get();

                $trashed->eans()->forceDelete();
                $trashed->images()->forceDelete();

                foreach ($nutrientGroups as $nutrientGroup) {

                    $nutrientGroup->nutrients()->delete();
                    $nutrientGroup->delete();

                }

                \App\Models\Scata\Products\ProductEan::where('product_id', $product->product_id)->forceDelete();

                $trashed->forceDelete();

            }

            //\App\Models\Scata\Products\Product::onlyTrashed()->forceDelete();
            \App\Models\Scata\Products\ProductEan::onlyTrashed()->forceDelete();
            \App\Models\Scata\Products\ProductImage::onlyTrashed()->forceDelete();


        });

    });


    Route::prefix('scannel')->namespace('Scannel')->group(function () {

        Route::get('ajaxRequest', 'AjaxController@ajaxRequest');
        Route::post('ajaxRequest', 'AjaxController@ajaxRequestPost')->name('ajaxRequest.post');


        Route::get('openproducts/{category?}'   , 'ProductController@openproducts') ->name('get.scannel.openproducts')->middleware('can:open-products.read');
        Route::get('openproduct/{product?}'     , 'ProductController@openproduct')  ->name('get.scannel.openproduct')->middleware('can:open-products.read');


        Route::get('products/{category?}'   , 'ProductController@products') ->name('get.scannel.products')->middleware('can:scannel-products.read');
        Route::get('product/{product?}'     , 'ProductController@product')  ->name('get.scannel.product')->middleware('can:scannel-products.read');
        Route::post('product/{product?}'    , 'ProductController@save')   ->name('post.saveproduct')->middleware('can:scannel-products.edit');
        Route::get('products/{delete?}'     , 'ProductController@delete')  ->name('get.scannelproductdelete')->middleware('can:scannel-products.delete');

        Route::get('bot/products/{category?}'   , 'BotProductController@products') ->name('get.scannel.bot.products')->middleware('can:bot-products.read');
        Route::get('bot/product/{category?}'   , 'BotProductController@product') ->name('get.scannel.bot.product')->middleware('can:bot-products.read');
        Route::post('bot/product/{product?}'    , 'BotProductController@save')   ->name('post.savebotproduct')->middleware('can:bot-products.edit');

        Route::get('ingredient/ingredients/{category?}'   , 'IngredientController@ingredients') ->name('get.scannel.ingredients')->middleware('can:ingredients.read');
        Route::get('ingredient/ingredients/ajax/{category?}'   , 'IngredientController@ingredientsAjax') ->name('get.scannel.ingredients-ajax')->middleware('can:ingredients.read');
        Route::get('ingredient/ingredients/ajax/search/{category?}'   , 'IngredientController@ingredientsSearchAjax') ->name('get.scannel.ingredients-search-ajax')->middleware('can:ingredients.read');
        Route::post('ingredient/ingredients/ajax/create'   , 'IngredientController@createAjax') ->name('get.scannel.ingredients-create-ajax')->middleware('can:ingredients.edit');
        Route::get('ingredient/ingredient/{category?}'   , 'IngredientController@ingredient') ->name('get.scannel.ingredient')->middleware('can:ingredients.read');
        Route::post('ingredient/ingredient/{ingredient?}'    , 'IngredientController@save')   ->name('post.saveingredient')->middleware('can:ingredients.edit');
        Route::get('ingredient/ingredients/delete/{delete?}'     , 'IngredientController@delete')  ->name('get.scannelingredientdelete')->middleware('can:ingredients.delete');

        Route::get('ingredient/split/{ingredient?}'     , 'IngredientController@split')  ->name('get.scannel.split')->middleware('can:ingredients.edit');
        Route::post('ingredient/split/{ingredient?}'     , 'IngredientController@split')  ->name('post.scannel.split')->middleware('can:ingredients.edit');

        Route::get('ingredient/ingredientgroups/{category?}'   , 'IngredientGroupsController@ingredientgroups') ->name('get.scannel.ingredientgroups')->middleware('can:ingredients.read');
        Route::get('ingredient/ingredientgroup/{category?}'   , 'IngredientGroupsController@ingredientgroup') ->name('get.scannel.ingredientgroup')->middleware('can:ingredients.read');
        Route::post('ingredient/ingredientgroup/{ingredient?}'    , 'IngredientGroupsController@save')   ->name('post.saveingredientgroup')->middleware('can:ingredients.edit');
    });
});


