<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ORM\HasLifecycleCallbacks]
class Users
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[ORM\Column(name: 'id', type: Types::GUID, unique: true, nullable: false)]
    private string $id;

    #[ORM\Column]
    private string $email;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private int $age;

    #[ORM\Column]
    private string $sex;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private \DateTime $birthday;

    #[ORM\Column]
    private string $phone;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->setCreatedAt(new \DateTime());
    }

    #[ORM\PreFlush]
    public function preFlush(): void
    {
        $this->setUpdatedAt(new \DateTime());
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Users
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Users
    {
        $this->email = $email;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Users
    {
        $this->name = $name;
        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): Users
    {
        $this->age = $age;
        return $this;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function setSex(string $sex): Users
    {
        $this->sex = $sex;
        return $this;
    }

    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTime $birthday): Users
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Users
    {
        $this->phone = $phone;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): Users
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): Users
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function __toString(): string
    {
        return "id: " . $this->id . PHP_EOL .
            "email: " . $this->email . PHP_EOL .
            "name: " . $this->name . PHP_EOL .
            "age: " . $this->age . PHP_EOL .
            "sex: " . $this->sex . PHP_EOL .
            "birthday: " . $this->birthday->format('Y-m-d') . PHP_EOL .
            "phone: " . $this->phone . PHP_EOL .
            "created_at: " . $this->createdAt->format('Y-m-d H:i:s.u') . PHP_EOL .
            "updated_at: " . $this->updatedAt->format('Y-m-d H:i:s.u') . PHP_EOL;
    }


}
