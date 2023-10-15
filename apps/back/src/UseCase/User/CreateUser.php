<?php

declare(strict_types=1);

namespace App\UseCase\User;

use App\Dto\Request\User\CreateUserDto;
use App\Dto\Request\User\UpdateUserDto;
use App\Entity\User;
use App\Mailer\UserMailer;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CreateUser
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
        private readonly UserMailer $userMailer,
        private readonly UpdateUser $updateUser,
    ) {
    }

    public function createUser(CreateUserDto $userDto, ?UploadedFile $profilePicture = null): User
    {
        if ($this->userRepository->findOneBy(['email' => $userDto->getEmail()])) {
            throw new BadRequestHttpException('Email already exists');
        }

        $user = new User($userDto->getEmail());
        $this->updateUser->updateUser($user, new UpdateUserDto($userDto->getEmail(), $userDto->getPassword()), $profilePicture);
        $this->entityManager->persist($user);

        $this->userMailer->sendRegistrationMail($user);

        return $user;
    }
}
