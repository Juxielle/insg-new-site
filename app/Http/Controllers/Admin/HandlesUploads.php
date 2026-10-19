<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait HandlesUploads
{
    /**
     * Gère l'enregistrement d'une image (soit uploadée, soit chemin/URL spécifié).
     */
    protected function handleImageUpload(
        Request $request,
        string $fileInput = 'image_file',
        string $textInput = 'image',
        string $subfolder = 'general',
        ?string $currentValue = null
    ): ?string {
        // 1. Si un fichier a été uploadé
        if ($request->hasFile($fileInput)) {
            $file = $request->file($fileInput);
            $extension = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '_' . time() . '.' . $extension;
            
            $targetDir = public_path('uploads/' . $subfolder);
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            
            $file->move($targetDir, $filename);
            return 'uploads/' . $subfolder . '/' . $filename;
        }

        // 2. Si un chemin ou URL textuel a été saisi
        if ($request->filled($textInput)) {
            return trim($request->input($textInput));
        }

        // 3. Conserver la valeur existante
        return $currentValue;
    }
}

