<?php

namespace CloudyCity\TencentMarketingSDK\Asset\Video;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;
use CloudyCity\TencentMarketingSDK\Resources;

class Client extends BaseClient
{
    protected $resource = Resources::VIDEOS;

    protected $fields = [
        'video_id', 'width', 'height', 'video_frames', 'video_fps', 'video_codec', 'video_bit_rate', 'audio_codec',
        'audio_bit_rate', 'file_size', 'type', 'signature', 'system_status', 'description', 'preview_url',
        'create_time', 'last_modified_time', 'video_profile_name', 'audio_sample_rate', 'max_keyframe_interval',
        'min_keyframe_interval', 'sample_aspect_ratio', 'audio_profile_name', 'scan_type', 'image_duration_millisecond',
        'audio_duration_millisecond', 'source_type'
    ];

    /**
     * @return array
     */
    public function getValidActions()
    {
        return ['get', 'add'];
    }
}
