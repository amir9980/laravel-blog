<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;
use function Symfony\Component\Translation\t;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'username'=>$this->username,
            'role'=> new RoleResource($this->whenLoaded('role')),
            'status'=>$this->status,
            'user_abilities'=>[
                $this->when(Gate::allows('status',$this),'status'),
                $this->when(Gate::allows('delete',$this),'delete'),
                $this->when(Gate::allows('update',$this),'update'),
            ],
            'articles_count'=> $this->whenCounted('articles'),
            'comments_count'=> $this->whenCounted('comments'),
            'created_at'=>$this->created_at
        ];
    }
}
