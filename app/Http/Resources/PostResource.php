<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\JsonResource;

    class PostResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @param \Illuminate\Http\Request $request
         * @return array
         */
        public function toArray($request)
        {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'task' => $this->task,
                'is_task_done' => $this->is_task_done,
                'order' => $this->order,
                'deadline' => $this->deadline,
                'created_at' => $this->created_at->toDateString(),
            ];
        }
    }
