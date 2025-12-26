<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * LocalStorageService - Handle image upload to local storage
 * Clean Architecture: Single responsibility untuk local storage operations
 */
class LocalStorageService
{
    private $storagePath = 'aset';

    /**
     * Upload image to local storage dengan optimasi
     * Clean Code: Clear method name, proper error handling
     */
    public function uploadImage(UploadedFile $file, string $folder = 'reports'): array
    {
        try {
            // Validate file
            $this->validateFile($file);

            // Generate unique filename
            $filename = $this->generateFilename($file);

            // Create folder if not exists
            $fullPath = $this->storagePath . '/' . $folder;
            if (!Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->makeDirectory($fullPath);
            }

            // Store file
            $path = $file->storeAs($fullPath, $filename, 'public');

            // Get public URL
            $publicUrl = Storage::disk('public')->url($path);

            Log::info('Local storage upload successful', [
                'path' => $path,
                'public_url' => $publicUrl,
                'filename' => $filename
            ]);

            return [
                'success' => true,
                'path' => $path,
                'public_url' => $publicUrl,
                'filename' => $filename,
                'size' => $file->getSize()
            ];

        } catch (\Exception $e) {
            Log::error('Local storage upload failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete image from local storage
     * Clean Code: Clear method name, proper error handling
     */
    public function deleteImage(string $path): array
    {
        try {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);

                Log::info('Local storage delete successful', [
                    'path' => $path
                ]);

                return [
                    'success' => true
                ];
            } else {
                Log::warning('File not found for deletion', [
                    'path' => $path
                ]);

                return [
                    'success' => false,
                    'error' => 'File not found'
                ];
            }

        } catch (\Exception $e) {
            Log::error('Local storage delete failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get public URL for stored image
     * Clean Code: Clear method name, proper URL generation
     */
    public function getPublicUrl(string $path): string
    {
        return Storage::disk('public')->url($path);
    }

    /**
     * Validate uploaded file
     * Clean Code: Input validation, security check
     */
    private function validateFile(UploadedFile $file): void
    {
        // Check file size (5MB max)
        if ($file->getSize() > 5120000) {
            throw new \Exception('File size exceeds maximum limit of 5MB');
        }

        // Check file type
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            throw new \Exception('File type not allowed. Allowed types: ' . implode(', ', $allowedMimeTypes));
        }

        // Check file extension
        $allowedFormats = ['jpeg', 'png', 'jpg', 'gif', 'webp'];
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
