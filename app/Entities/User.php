<?php
namespace App\Entities;

use App\Validations\Validator;
use App\Validations\Name;
use App\Validations\Cpf;
use App\Validations\BirthDate;
use App\Validations\Email;
use App\Validations\Telephone;
use App\Validations\Street;
use App\Validations\City;
use App\Validations\State;
use JsonSerializable;
use DateTime;

class User implements JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cpf;

    /**
     * @var string
     */
    private $birthDate;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telephone;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Retorna instância de validação da entidade
     *
     * @return \App\Validations\Validator
     */
    public function getValidator()
    {
        return Validator::make($this->getAttributes(), $this->getValidateRules());
    }

    /**
     * Retorna todos atributos da entidade
     *
     * @return array
     */
    public function getAttributes()
    {
        return \get_object_vars($this);
    }

    /**
     * Retorna todas regras de validação da entidade
     *
     * @return array
     */
    private function getValidateRules()
    {
        return [
            'name' => Name::make('name'),
            'cpf' => Cpf::make('cpf'),
            'birthDate' => BirthDate::make('birthDate'),
            'email' => Email::make('email'),
            'telephone' => Telephone::make('telephone'),
            'street' => Street::make('street'),
            'city' => City::make('city'),
            'state' => State::make('state'),
        ];
    }

    /**
     * Retorna todos atributos da entidade para serialização
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getAttributes();
    }
}
