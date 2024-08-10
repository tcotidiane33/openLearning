<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Media;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;

class VideoProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mediaId;

    public function __construct($mediaId)
    {
        $this->mediaId = $mediaId;
    }

    public function handle()
    {
        $media = Media::findOrFail($this->mediaId);
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open(storage_path('app/public/' . $media->file_path));
        
        // Compression
        $video->filters()->resize(new Dimension(1280, 720))->synchronize();
        $compressedPath = 'compressed_' . $media->file_path;
        $video->save(new X264(), storage_path('app/public/' . $compressedPath));

        // Génération de miniature
        $thumbnailPath = 'thumbnail_' . pathinfo($media->file_path, PATHINFO_FILENAME) . '.jpg';
        $video->frame(TimeCode::fromSeconds(5))->save(storage_path('app/public/' . $thumbnailPath));

        // Mise à jour du media
        $media->update([
            'file_path' => $compressedPath,
        ]);

        // Ajout de la miniature comme nouveau media
        $media->mediable->addMedia(storage_path('app/public/' . $thumbnailPath), 'thumbnail');
    }
}