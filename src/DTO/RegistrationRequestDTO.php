<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class RegistrationRequestDTO implements DTOResolverInterface
{
    #[Assert\NotBlank(message: 'Email cannot be empty.')]
    #[Assert\Regex('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/', message: 'Email\'s value does not fit.')]
    private string $email;

    #[Assert\NotBlank(message: 'Name cannot be empty.')]
    #[Assert\Type(type: 'string', message: 'Name\'s value {{ value }} is not a string.')]
    #[Assert\Length(
        min: 1,
        max: 1100,
        minMessage: 'Name must be not less than {{ limit }} characters.',
        maxMessage: 'Name must be not more than {{ limit }} characters.'
    )]
    private string $name;

    #[Assert\NotBlank(message: 'Age cannot be empty.')]
    #[Assert\Type(type: 'int', message: 'Age\'s value {{ value }} is not a int.')]
    #[Assert\Range(notInRangeMessage: 'Age should be 6 - 154 years', min: 6, max: 154)]
    private int $age;

    #[Assert\NotBlank(message: 'Sex cannot be empty.')]
    #[Assert\Type(type: 'string', message: 'Sex\'s value {{ value }} is not a char.')]
    private string $sex;

    #[Assert\NotBlank(message: 'Birthday cannot be empty.')]
    private \DateTime $birthday;

    #[Assert\NotBlank(message: 'Phone cannot be empty.')]
    #[Assert\Type(type: 'string', message: 'Phone\'s value {{ value }} is not a string.')]
    #[Assert\Regex('/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/', message: 'Phone\'s value does not fit.')]
    private string $phone;

    #[Assert\IsTrue(
        message: 'Sex can be only m,M or f,F'
    )]
    public function isSexValid(): bool
    {
        return $this->sex === 'm' ||
            $this->sex === 'M' ||
            $this->sex === 'f' ||
            $this->sex === 'F';
    }

    #[Assert\isTrue(
        message: 'The birthday value is not the correct format.'
    )]
    public function isBirthdayFormatValid(): bool
    {
        $is_0 = true;

        try {
            $this->birthday->format('Y-m-d');
            $yearSymbols = $this->birthday->format('Y');
            $yearSymbols == 4 ?: throw new \Exception();
        } catch (\Exception) {
            $is_0 = false;
        }

        return $is_0;
    }

    #[Assert\isTrue(
        message: 'Birthday can only be in the range of: 1870-01-01 - 2018-01-01'
    )]
    public function isBirthdayRangeValid(): bool
    {
        return $this->birthday >= new \DateTime('1870-01-01') &&
            $this->birthday <= new \DateTime('2018-01-01');
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): RegistrationRequestDTO
    {
        $this->email = $email;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): RegistrationRequestDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): RegistrationRequestDTO
    {
        $this->age = $age;
        return $this;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function setSex(string $sex): RegistrationRequestDTO
    {
        $this->sex = $sex;
        return $this;
    }

    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $birthday): RegistrationRequestDTO
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): RegistrationRequestDTO
    {
        $this->phone = $phone;
        return $this;
    }
}
