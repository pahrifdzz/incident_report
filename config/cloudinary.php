<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cloudinary Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration untuk Cloudinary image upload service
    | Clean Architecture: Centralized configuration untuk cloud storage
    |
    */

    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
    'api_key' => env('CLOUDINARY_API_KEY'),
    'api_secret' => env('CLOUDINARY_API_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Default Upload Settings
    |--------------------------------------------------------------------------
    |
    | Default settings untuk upload images ke Cloudinary
    | Clean Code: Consistent upload behavior
    |
    */

    'default_folder' => 'reports',
    'default_format' => 'webp',
    'default_quality' => 'auto',
    'default_transformation' => [
        'quality' => 'auto',
        'format' => 'webp',
        'fetch_format' => 'auto'
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Optimization Settings
    |--------------------------------------------------------------------------
    |
    | Settings untuk optimasi image size dan quality
    | Clean Code: Performance optimization
    |
    */

    'max_width' => 1920,
    'max_height' => 1080,
    'max_file_size' => 5242880, // 5MB in bytes

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Security settings untuk upload protection
    | Clean Code: Security best practices
    |
    */

    'allowed_formats' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
    'allowed_mime_types' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
];
