<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'task' => $this->task,
            'status_id' => $this->status,
            'added_by' => $this->r_added->name,
            'status' => $this->getStatus(),
            'remark' => $this->remark,
        ];
    }
}
