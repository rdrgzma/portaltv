<?php

namespace App\Observers;

use App\Models\Video;

class VideoObserver
{
    public function saving(Video $video): void
    {
        if ($video->isDirty('youtube_url') && !empty($video->youtube_url)) {
            $video->youtube_video_id = $this->extractYoutubeId($video->youtube_url);
        }
    }

    private function extractYoutubeId($url)
    {
        // Regex para pegar ID de url padrão, encurtada ou embed
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}