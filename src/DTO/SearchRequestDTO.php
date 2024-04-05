<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class SearchRequestDTO implements DTOResolverInterface
{
    #[Assert\NotBlank(message: 'Email cannot be empty.')]
    #[Assert\Regex('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/')]
    private string $email;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): SearchRequestDTO
    {
        $this->email = $email;
        return $this;
    }
}
