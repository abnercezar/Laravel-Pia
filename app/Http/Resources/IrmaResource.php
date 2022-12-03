<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IrmaResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'contatos' => ContatoResource::collection($this->whenLoaded('contatos')),
            'comuns' => ComumResource::collection($this->whenLoaded('comuns')),
        ];
    }
}
