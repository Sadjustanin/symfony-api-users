<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class ChangeEmailRequestDTO implements DTOResolverInterface
{
    #[Assert\NotBlank(message: 'Email cannot be empty.')]
    #[Assert\Regex('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/')]
    private string $emailOld;

    #[Assert\NotBlank(message: 'Email cannot be empty.')]
    #[Assert\Regex('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/')]
    private string $emailNew;

    public function getEmailOld(): string
    {
        return $this->emailOld;
    }

    public function setEmailOld(string $email): ChangeEmailRequestDTO
    {
        $this->emailOld = $email;
        return $this;
    }

    public function getEmailNew(): string
    {
        return $this->emailNew;
    }

    public function setEmailNew(string $email): ChangeEmailRequestDTO
    {
        $this->emailNew = $email;
        return $this;
    }
}
