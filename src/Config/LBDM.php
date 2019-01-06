<?php

return [

    /* Important Settings */

    // ======================================================================
    // never remove 'web', . just put your middleware like auth or admin (if you have) here. eg: ['web','auth']
    'private_middlewares'  => explode(',', env('LBDM_BACKEND_MIDDLEWARES', 'web')),
    'public_middlewares'   => explode(',', env('LBDM_FRONTEND_MIDDLEWARES', 'web')),
    // you can change default route from sms-admin to anything you want
    'private_route_prefix' => env('LBDM_BACKEND_ROUTE_PREFIX', 'LBDM'),
    'public_route_prefix'  => env('LBDM_FRONTEND_ROUTE_PREFIX', 'LBDM'),
    // ======================================================================

    'lbdm_get_user_model_name' => env('LBDM_GET_USER_MODEL_NAME', 'App\User'),

];