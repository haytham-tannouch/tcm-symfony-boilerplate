<?php

namespace App\Dto\Request\User;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait ProfilePicture
{

    private ?UploadedFile $profilePicture;

    public function getProfilePicture(): ?UploadedFile
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?UploadedFile $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }

}