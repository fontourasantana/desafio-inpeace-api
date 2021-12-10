<?php

use App\Factories\UserFactory as Instance;
use App\Exceptions\RequiredAttributesException;

class UserFactoryTest extends TestCase
{
    protected $instance;

    protected function setUp(): void
    {
        parent::setUp();
        $this->instance = $this->app->make('App\Contracts\Factories\UserFactory');
    }

    public function testShouldReturnUserFactoryInstance()
    {
        $this->assertInstanceOf(Instance::class, $this->instance);
    }

    public function testUserFactoryThrowsRequiredAttributesException()
    {
        $this->expectException(App\Exceptions\RequiredAttributesException::class);
        $request = $this->createMock(Illuminate\Http\Request::class);
        $this->instance->makeFromRequest($request);
    }

    public function testUserFactoryReturnUserEntityFromRequest()
    {
        $requestData = [
            'id' => 1,
            'nome' => 'teste',
            'cpf' => '16539585020',
            'dataNascimento' => '2021-12-10',
            'email' => 'teste@email.br',
            'telefone' => '1234567890',
            'logradouro' => 'rua teste',
            'cidade' => 'Vitória',
            'estado' => 'ES'
        ];

        $requiredAttributes = $this->getPrivateProperty($this->instance, 'requiredAttributes');

        $request = $this->createMock(Illuminate\Http\Request::class);

        $request->expects($this->any())
            ->method('has')
            ->with($requiredAttributes)
            ->willReturn(true);

        $request->expects($this->any())
            ->method('only')
            ->with($requiredAttributes)
            ->willReturn($requestData);

        $entity = $this->instance->makeFromRequest($request);
        $this->assertInstanceOf(App\Entities\User::class, $entity);
        $this->assertEquals(null, $entity->getId());
        $this->assertEquals($requestData['nome'], $entity->getName());
        $this->assertEquals($requestData['cpf'], $entity->getCpf());
        $this->assertEquals($requestData['dataNascimento'], $entity->getBirthDate());
        $this->assertEquals($requestData['email'], $entity->getEmail());
        $this->assertEquals($requestData['telefone'], $entity->getTelephone());
        $this->assertEquals($requestData['logradouro'], $entity->getStreet());
        $this->assertEquals($requestData['cidade'], $entity->getCity());
        $this->assertEquals($requestData['estado'], $entity->getState());
        $this->assertEquals(null, $entity->getCreatedAt());
        $this->assertEquals(null, $entity->getUpdatedAt());
    }

    public function testUserFactoryReturnUserEntityFromAttributes()
    {
        $attributes = [
            'id' => 1,
            'nome' => 'teste',
            'cpf' => '16539585020',
            'dataNascimento' => '2021-12-10',
            'email' => 'teste@email.br',
            'telefone' => '1234567890',
            'logradouro' => 'rua teste',
            'cidade' => 'Vitória',
            'estado' => 'ES',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $entity = $this->instance->makeFromAttributes($attributes);
        $this->assertInstanceOf(App\Entities\User::class, $entity);
        $this->assertEquals($attributes['id'], $entity->getId());
        $this->assertEquals($attributes['nome'], $entity->getName());
        $this->assertEquals($attributes['cpf'], $entity->getCpf());
        $this->assertEquals($attributes['dataNascimento'], $entity->getBirthDate());
        $this->assertEquals($attributes['email'], $entity->getEmail());
        $this->assertEquals($attributes['telefone'], $entity->getTelephone());
        $this->assertEquals($attributes['logradouro'], $entity->getStreet());
        $this->assertEquals($attributes['cidade'], $entity->getCity());
        $this->assertEquals($attributes['estado'], $entity->getState());
        $this->assertEquals(new DateTime($attributes['created_at']), $entity->getCreatedAt());
        $this->assertEquals(new DateTime($attributes['updated_at']), $entity->getUpdatedAt());
    }
}
