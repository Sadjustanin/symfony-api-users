<?php

namespace App\Controller\Api;

use App\DTO\ChangeEmailRequestDTO;
use App\DTO\DeleteRequestDTO;
use App\DTO\RegistrationRequestDTO;
use App\DTO\SearchRequestDTO;
use App\Exception\DuplicateException;
use App\Exception\UserNotFoundException;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService
    )
    {}

    /**
     * @throws DuplicateException
     */
    #[Route('/register', name: 'register', methods: 'POST')]
    public function register(RegistrationRequestDTO $requestDTO): JsonResponse
    {
        $this->userService->register(
            $requestDTO->getEmail(),
            $requestDTO->getName(),
            $requestDTO->getAge(),
            $requestDTO->getSex(),
            $requestDTO->getBirthday(),
            $requestDTO->getPhone()
        );

        return new JsonResponse('Success');
    }

    /**
     * @throws UserNotFoundException
     */
    #[Route('/search', name: 'search', methods: 'GET')]
    public function search(SearchRequestDTO $requestDTO): JsonResponse
    {
        $user = $this->userService->getUser(
            $requestDTO->getEmail()
        );

        return new JsonResponse($user, json: true);
    }

    /**
     * @throws UserNotFoundException
     * @throws DuplicateException
     */
    #[Route('/changeEmail', name: 'changeEmail', methods: 'PUT')]
    public function changeEmail(ChangeEmailRequestDTO $requestDTO): JsonResponse
    {
        $this->userService->editUserEmail(
            $requestDTO->getEmailOld(),
            $requestDTO->getEmailNew()
        );

        return new JsonResponse('Success');
    }

    /**
     * @throws UserNotFoundException
     */
    #[Route('/delete', name: 'delete', methods: 'DELETE')]
    public function delete(DeleteRequestDTO $requestDTO): JsonResponse
    {
        $this->userService->deleteUser(
            $requestDTO->getEmail()
        );

        return new JsonResponse('Success');
    }
}
