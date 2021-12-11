<?php

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\EntityValidationException;
use App\Contracts\Repositories\UserRepository;

class UserServiceTest extends TestCase
{
    private $service;

    private function createService()
    {
        $this->service = $this->app->make('App\Services\UserService');
    }

    private function bindUserRepository(UserRepository $repository)
    {
        $this->app->bind(App\Contracts\Repositories\UserRepository::class, function () use ($repository) {
            return $repository;
        });
    }

    public function testShouldReturnUserServiceInstance()
    {
        $this->createService();
        $this->assertInstanceOf(App\Services\UserService::class, $this->service);
    }

    public function testUserServiceReturnCollection()
    {
        $repositoryMock = $this->createMock(App\Contracts\Repositories\UserRepository::class);
        $repositoryMock->method('getAll')->willReturn(collect());
        $this->bindUserRepository($repositoryMock);
        $this->createService();
        $collection = $this->service->getAll();
        $this->assertInstanceOf(Illuminate\Support\Collection::class, $collection);
    }

    public function testUserServiceReturnUserEntityById()
    {
        $repositoryMock = $this->createMock(App\Contracts\Repositories\UserRepository::class);
        $user = $this->createMock(App\Entities\User::class);
        $repositoryMock->method('getById')->with(1)->willReturn($user);
        $this->bindUserRepository($repositoryMock);
        $this->createService();
        $entity = $this->service->getById(1);
        $this->assertInstanceOf(App\Entities\User::class, $entity);
    }

    public function testUserServiceThrowsEntityNotFoundExceptionOnGetById()
    {
        $this->expectException(App\Exceptions\EntityNotFoundException::class);
        $repositoryMock = $this->createMock(App\Contracts\Repositories\UserRepository::class);
        $repositoryMock->method('getById')->with(1)->willReturn(null);
        $this->bindUserRepository($repositoryMock);
        $this->createService();
        $entity = $this->service->getById(1);
    }

    public function testUserServiceThrowsEntityValidationExceptionOnSave()
    {
        $this->expectException(App\Exceptions\EntityValidationException::class);
        $validatorMock = $this->createMock(App\Validations\Validator::class);
        $validatorMock->method('validate')->willReturn(false);
        $validatorMock->method('getErrors')->willReturn(['teste message']);
        $userMock = $this->createMock(App\Entities\User::class);
        $userMock->method('getValidator')->willReturn($validatorMock);
        $this->createService();
        $this->service->save($userMock);
    }

    public function testUserServiceSaveUserEntity()
    {
        $validatorMock = $this->createMock(App\Validations\Validator::class);
        $validatorMock->method('validate')->willReturn(true);
        $userMock = $this->createMock(App\Entities\User::class);
        $userMock->method('getValidator')->willReturn($validatorMock);
        $repositoryMock = $this->createMock(App\Contracts\Repositories\UserRepository::class);
        $repositoryMock->method('save')->with($userMock)->willReturn($userMock);
        $this->bindUserRepository($repositoryMock);
        $this->createService();
        $user = $this->service->save($userMock);
        $this->assertInstanceOf(App\Entities\User::class, $user);
    }

    public function testUserServiceThrowsEntityValidationExceptionOnUpdate()
    {
        $this->expectException(App\Exceptions\EntityValidationException::class);
        $validatorMock = $this->createMock(App\Validations\Validator::class);
        $validatorMock->method('validate')->willReturn(false);
        $validatorMock->method('getErrors')->willReturn(['teste message']);
        $userMock = $this->createMock(App\Entities\User::class);
        $userMock->method('getValidator')->willReturn($validatorMock);
        $this->createService();
        $dto = new App\Entities\User;
        $user = $this->service->update($userMock, $dto);
    }

    public function testUserServiceUpdateUserEntity()
    {
        $validatorMock = $this->createMock(App\Validations\Validator::class);
        $validatorMock->method('validate')->willReturn(true);
        $userMock = $this->createMock(App\Entities\User::class);
        $userMock->method('getValidator')->willReturn($validatorMock);
        $repositoryMock = $this->createMock(App\Contracts\Repositories\UserRepository::class);
        $repositoryMock->method('update')->with($userMock)->willReturn($userMock);
        $this->bindUserRepository($repositoryMock);
        $this->createService();
        $dto = new App\Entities\User;
        $user = $this->service->update($userMock, $dto);
        $this->assertInstanceOf(App\Entities\User::class, $user);
    }

    public function testUserServicePrepareUserEntityToUpdate()
    {
        $user = new App\Entities\User;
        $dto = new App\Entities\User;

        $dto->setName('teste');
        $dto->setCpf('16539585020');
        $dto->setBithDate('2021-12-10');
        $dto->setEmail('teste@email.br');
        $dto->setTelephone('1234567890');
        $dto->setStreet('rua teste');
        $dto->setCity('Vitória');
        $dto->setState('ES');

        $this->createService();
        $user = $this->invokePrivateMethod($this->service, 'prepareUpdate', [$user, $dto]);

        $this->assertInstanceOf(App\Entities\User::class, $user);
        $this->assertEquals(null, $user->getId());
        $this->assertEquals('teste', $user->getName());
        $this->assertEquals('16539585020', $user->getCpf());
        $this->assertEquals('2021-12-10', $user->getBirthDate());
        $this->assertEquals('teste@email.br', $user->getEmail());
        $this->assertEquals('1234567890', $user->getTelephone());
        $this->assertEquals('rua teste', $user->getStreet());
        $this->assertEquals('Vitória', $user->getCity());
        $this->assertEquals('ES', $user->getState());
        $this->assertEquals(null, $user->getCreatedAt());
        $this->assertEquals(null, $user->getUpdatedAt());
    }

    public function testUserServiceThrowsInvalidArgumentExceptionOnDelete()
    {
        $this->expectException(InvalidArgumentException::class);
        $userMock = $this->createMock(App\Entities\User::class);
        $repositoryMock = $this->createMock(App\Contracts\Repositories\UserRepository::class);
        $repositoryMock->method('delete')->with($userMock)->willReturn(false);
        $this->bindUserRepository($repositoryMock);
        $this->createService();
        $this->service->delete($userMock);
    }
}
