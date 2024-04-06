<?php

namespace App\Service;

use App\Entity\Users;
use App\Exception\DuplicateException;
use App\Exception\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class UserService
{
    private readonly EntityRepository $userRepository;

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
        $this->userRepository = $this->entityManager->getRepository(Users::class);
    }

    /**
     * @throws DuplicateException
     * @throws \Exception
     */
    public function register(string $email,
        string $name,
        string $age,
        string $sex,
        \DateTime $birthday,
        string $phone): void
    {
        if (null !== $this->userRepository->findOneBy(['email' => $email])) {
            throw new DuplicateException();
        }

        $user = (new Users())
            ->setEmail($email)
            ->setName($name)
            ->setAge((int) $age)
            ->setSex($sex)
            ->setBirthday($birthday)
            ->setPhone($phone);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUser(string $email): Users
    {
        /**
         * @var Users|null $user
         */
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @throws UserNotFoundException
     * @throws DuplicateException
     */
    public function editUserEmail(string $emailOld, string $emailNew): void
    {
        /**
         * @var Users|null $user
         */
        $user = $this->userRepository->findOneBy(['email' => $emailOld]);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        if (null !== $this->userRepository->findOneBy(['email' => $emailNew])) {
            throw new DuplicateException();
        }

        $user->setEmail($emailNew);
        $this->entityManager->flush();
    }

    /**
     * @throws UserNotFoundException
     */
    public function deleteUser(string $email): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
