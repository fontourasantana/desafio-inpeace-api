<?php
namespace App\Http\Controllers;

use App\Contracts\Services\UserService;
use App\Contracts\Factories\UserFactory;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $service;

    private $entityFactory;

    public function __construct(UserService $service, UserFactory $entityFactory)
    {
        $this->service = $service;
        $this->entityFactory = $entityFactory;
    }

    public function index()
    {
        $users = $this->service->getAll();

        return app('api.response')
            ->success()
            ->data(compact('users'))
            ->send();
    }

    public function show(int $id)
    {
        $user = $this->service->getById($id);

        return app('api.response')
            ->success()
            ->data(compact('user'))
            ->send();
    }

    public function store(Request $request)
    {
        $user = $this->entityFactory->makeFromRequest($request);
        $user = $this->service->save($user);

        return app('api.response')
            ->created('Usuário registrado com sucesso !')
            ->data(compact('user'))
            ->send();
    }

    public function update(Request $request, int $id)
    {
        $dto = $request->only(['nome', 'cpf', 'dataNascimento', 'email', 'telefone', 'logradouro', 'cidade', 'estado']);
        $user = $this->service->getById($id);
        $attributes = array_merge(
            $dto,
            ['id' => $user->getId(), 'created_at' => $user->getCreatedAt(), 'updated_at' => $user->getUpdatedAt()]
        );

        $user = $this->entityFactory->makeFromAttributes($attributes);
        $user = $this->service->update($user);

        return app('api.response')
            ->success('Usuário atualizado com sucesso !')
            ->data(compact('user'))
            ->send();
    }

    public function destroy(int $id)
    {
        $user = $this->service->getById($id);
        $this->service->delete($user);
        return app('api.response')->success('Usuário removido com sucesso !')->send();
    }
}
