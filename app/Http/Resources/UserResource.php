<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getName(),
            'cpf' => $this->getCpf(),
            'dataNascimento' => $this->getBirthDate(),
            'email' => $this->getEmail(),
            'telefone' => $this->getTelephone(),
            'logradouro' => $this->getStreet(),
            'cidade' => $this->getCity(),
            'estado' => $this->getState()
        ];
    }
}
