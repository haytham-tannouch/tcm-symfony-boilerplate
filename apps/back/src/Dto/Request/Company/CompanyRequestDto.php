<?php

namespace App\Dto\Request\Company;

class CompanyRequestDto
{

    private ?UplaodedFile $indentityFile;

    public function __construct(
        private readonly int|null $id,
        private readonly string $name,
    )
    {
    }

    public function getIndentityFile(): ?UplaodedFile
    {
        return $this->indentityFile;
    }

    public function setIndentityFile(?UplaodedFile $indentityFile): void
    {
        $this->indentityFile = $indentityFile;
    }





}