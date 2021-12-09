<?php
namespace App\Http\Controllers;

use App\Contracts\Services\UserService;
use App\Contracts\Factories\UserFactory;
use App\Entities\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Implementação do UserService
     *
     * @var \App\Contracts\Services\UserService
     */
    private $service;

    /**
     * Implementação da UserFactory
     *
     * @var \App\Contracts\Factories\UserFactory
     */
    private $entityFactory;

    /**
     * @param \App\Contracts\Services\UserService $service
     * @param \App\Contracts\Factories\UserFactory $entityFactory
     * @return void
     */
    public function __construct(UserService $service, UserFactory $entityFactory)
    {
        $this->service = $service;
        $this->entityFactory = $entityFactory;
    }

    /**
     * Faz parser da entidade User para o padrão esperado pelo front-end
     *
     * @param \App\Entities\User $user
     * @return array
     */
    private function parser(User $user)
    {
        $keysMap = [
            'id' => 'id',
            'name' => 'nome',
            'cpf' => 'cpf',
            'birthDate' => 'dataNascimento',
            'email' => 'email',
            'telephone' => 'telefone',
            'street' => 'logradouro',
            'city' => 'cidade',
            'state' => 'estado',
        ];

        $attributes = $user->getAttributes();
        $parsed = [];

        foreach ($attributes as $key => $value) {
            if (!isset($keysMap[$key])) {
                continue;
            }

            $parsed[$keysMap[$key]] = $value;
        }

        return $parsed;
    }

    /**
     * Retorna todos usuários do sistema
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->service->getAll();
        $users = $users->map(fn ($user) => $this->parser($user));

        return app('api.response')
            ->success()
            ->data(compact('users'))
            ->send();
    }

    /**
     * Retorna usuário do sistema pelo id
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = $this->service->getById($id);
        $user = $this->parser($user);

        return app('api.response')
            ->success()
            ->data(compact('user'))
            ->send();
    }

    /**
     * Salva usuário no sistema
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dto = $this->entityFactory->makeFromRequest($request);
        $user = $this->service->save($dto);
        $user = $this->parser($user);

        return app('api.response')
            ->created('Usuário registrado com sucesso !')
            ->data(compact('user'))
            ->send();
    }

    /**
     * Atualiza usuário no sistema
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $dto = $this->entityFactory->makeFromRequest($request);
        $user = $this->service->getById($id);
        $user = $this->service->update($user, $dto);
        $user = $this->parser($user);

        return app('api.response')
            ->success('Usuário atualizado com sucesso !')
            ->data(compact('user'))
            ->send();
    }

    /**
     * Deleta usuário no sistema
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = $this->service->getById($id);
        $this->service->delete($user);

        return app('api.response')
            ->success('Usuário removido com sucesso !')
            ->send();
    }
}
