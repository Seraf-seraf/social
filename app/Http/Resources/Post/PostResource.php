<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $url = isset($this->image) ? $this->image->url : null;
        return [
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $url,
            'date' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
