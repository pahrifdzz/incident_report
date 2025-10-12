<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Transformation\Resize;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

/**
 * CloudinaryService - Handle image upload to Cloudinary
 * Clean Architecture: Single responsibility untuk cloud storage operations
 */
class CloudinaryService
{
    private $cloudinary;
    private $uploadApi;

    public function __construct()
    {
        try {
            // Get credentials dari environment variables langsung
            $cloudName = env('CLOUDINARY_CLOUD_NAME');
            $apiKey = env('CLOUDINARY_API_KEY');
            $apiSecret = env('CLOUDINARY_API_SECRET');

            // Validate credentials
            if (empty($cloudName) || empty($apiKey) || empty($apiSecret)) {
                throw new \Exception('Cloudinary credentials not found in environment variables');
            }

            // Initialize Cloudinary dengan constructor langsung
            $this->cloudinary = new Cloudinary([
                'cloud' => [
                    'cloud_name' => $cloudName,
                    'api_key' => $apiKey,
                    'api_secret' => $apiSecret,
                ],
                'url' => [
                    'secure' => true
                ]
            ]);

            $this->uploadApi = $this->cloudinary->uploadApi();

            Log::info('CloudinaryService initialized successfully', [
                'cloud_name' => $cloudName,
                'api_key' => $apiKey ? 'Set' : 'Not set',
                'api_secret' => $apiSecret ? 'Set' : 'Not set'
            ]);

        } catch (\Exception $e) {
            Log::error('CloudinaryService initialization failed: ' . $e->getMessage());
            throw new \Exception('Cloudinary configuration failed: ' . $e->getMessage());
        }
    }

    /**
     * Upload image to Cloudinary dengan optimasi
     * Clean Code: Clear method name, proper error handling
     */
    public function uploadImage(UploadedFile $file, string $folder = 'reports'): array
    {
        try {
            // Validate file
            $this->validateFile($file);

            // Generate unique filename
            $filename = $this->generateFilename($file);

            // Upload to Cloudinary dengan optimasi
            $result = $this->uploadApi->upload(
                $file->getRealPath(),
                [
                    'public_id' => $folder . '/' . $filename,
                    'folder' => $folder,
                    'transformation' => [
                        'quality' => 'auto',
                        'format' => 'webp',
                        'fetch_format' => 'auto',
                        'width' => config('cloudinary.max_width'),
                        'height' => config('cloudinary.max_height'),
                        'crop' => 'limit'
                    ],
                    'resource_type' => 'image'
                ]
            );

            Log::info('Cloudinary upload successful', [
                'public_id' => $result['public_id'],
                'secure_url' => $result['secure_url'],
                'format' => $result['format']
            ]);

            return [
                'success' => true,
                'public_id' => $result['public_id'],
                'secure_url' => $result['secure_url'],
                'format' => $result['format'],
                'bytes' => $result['bytes']
            ];

        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete image from Cloudinary
     * Clean Code: Clear method name, proper error handling
     */
    public function deleteImage(string $publicId): array
    {
        try {
            $result = $this->uploadApi->destroy($publicId);

            Log::info('Cloudinary delete successful', [
                'public_id' => $publicId,
                'result' => $result
            ]);

            return [
                'success' => true,
                'result' => $result
            ];

        } catch (\Exception $e) {
            Log::error('Cloudinary delete failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Generate optimized URL untuk display
     * Clean Code: Clear method name, proper URL generation
     */
    public function getOptimizedUrl(string $publicId, array $transformations = []): string
    {
        $defaultTransformations = [
            'quality' => 'auto',
            'format' => 'webp',
            'fetch_format' => 'auto'
        ];

        $transformations = array_merge($defaultTransformations, $transformations);

        return $this->cloudinary->image($publicId)->transformation($transformations)->toUrl();
    }

    /**
     * Validate uploaded file
     * Clean Code: Input validation, security check
     */
    private function validateFile(UploadedFile $file): void
    {
        // Check file size
        if ($file->getSize() > config('cloudinary.max_file_size')) {
            throw new \Exception('File size exceeds maximum limit of 5MB');
        }

        // Check file type
        $allowedMimeTypes = config('cloudinary.allowed_mime_types');
        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            throw new \Exception('File type not allowed. Allowed types: ' . implode(', ', $allowedMimeTypes));
        }

        // Check file extension
        $allowedFormats = config('cloudinary.allowed_formats');
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedFormats)) {
            throw new \Exception('File format not allowed. Allowed formats: ' . implode(', ', $allowedFormats));
        }
    }

    /**
     * Generate unique filename
     * Clean Code: Clear method name, unique filename generation
     */
    private function generateFilename(UploadedFile $file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $timestamp = now()->format('Y-m-d_H-i-s');
        $randomString = substr(md5(uniqid()), 0, 8);

        return "report_{$timestamp}_{$randomString}.{$extension}";
    }
}