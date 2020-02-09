<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

/**
 * PHP Info
 */
$app->get('/phpinfo', function(){
    return phpinfo();
});

/**
 * Standard API
 *  These Routes use excite id_user for access to excite operations
 *  All Standard Routes must be included inside here
 */
$app->group(['middleware' => 'api', 'prefix' => '/api'], function () use ($app) {

    $app->post('vesselstracks/add',[
        'as' => 'vesselstracks', 'uses' => 'vesselstracks@add'
    ]);

    $app->post('vesselstracks/get',[
        'as' => 'vesselstracks', 'uses' => 'vesselstracks@get'
    ]);

});
