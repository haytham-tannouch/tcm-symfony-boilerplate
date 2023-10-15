<?php

declare(strict_types=1);

namespace App\UseCase\User;

use App\Dto\Request\User\UpdateUserDto;
use App\Entity\User;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UpdateUser
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly FilesystemOperator $publicStorage
    ) {
    }

    public function updateUser(User $user, UpdateUserDto $userDto): User
    {
        $user->setEmail($userDto->getEmail());

        if ($userDto->getPassword()) {
            $user->setPassword($this->passwordHasher->hashPassword($user, $userDto->getPassword()));
        }

        if  ($userDto->getProfilePicture()) {
            $profilePictureFileName = "user_pictures/profile_picture_" . $user->getId() . "." . $userDto->getProfilePicture()->getClientOriginalExtension();
            $this->publicStorage->write($profilePictureFileName, $userDto->getProfilePicture()->getContent());
            $user->setProfilePicture($profilePictureFileName);
        }

        return $user;
    }
}
