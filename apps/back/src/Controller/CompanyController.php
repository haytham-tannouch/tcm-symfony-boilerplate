<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Request\Company\CompanyRequestDto;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CompanyController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CompanyRepository $companyRepository,
    ) {
    }

    #[Route('/companies', name: 'list_companies', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $companies = $this->companyRepository->findAll();

        return $this->json($companies, 200, [], ['groups' => Company::GROUP_LIST]);
    }

    #[Route('/companies/{id}', name: 'get_company', methods: ['GET'])]
    #[IsGranted('ROLE_RIGHT_COMPANY_READ')]
    public function get(Company $company): JsonResponse
    {
        return $this->json($company);
    }

    #[Route('/companies', name: 'create_company', methods: ['POST'])]
    #[IsGranted('ROLE_RIGHT_COMPANY_CREATE')]
    public function create(#[MapRequestPayload] CompanyRequestDto $companyRequestDto): JsonResponse
    {
    }

    #[Route('/companies/{id}', name: 'update_company', methods: ['POST'])]
    #[IsGranted('ROLE_RIGHT_COMPANY_UPDATE')]
    public function update(Company $company, #[MapRequestPayload] CompanyRequestDto $companyRequestDto): JsonResponse
    {
    }

}
