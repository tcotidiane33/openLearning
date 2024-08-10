<?php

namespace App\Traits;

use App\Models\Media;

trait HasMedia
{
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function addMedia($file, $collectionName = null)
    {
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('media', 'public');
        
        return $this->media()->create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'collection_name' => $collectionName,
        ]);
    }

    public function getMedia($collectionName = null)
    {
        return $this->media()->when($collectionName, function ($query) use ($collectionName) {
            return $query->where('collection_name', $collectionName);
        })->get();
    }
}