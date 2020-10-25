<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Offer\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class CreateNewOfferInputValidator
{
    public function validate(array $input): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        $groups = $this->getValidationGroups();
        $constraints = $this->getValidationConstraints();
        return $validator->validate($input, $constraints, $groups);
    }

    private function getValidationConstraints(): Assert\Collection
    {
        // todo - load configuration from DB
        return new Assert\Collection([
            'name'              => [ new Assert\NotBlank(['message' => 'offer.name.not_blank']) ],
            'totalPrice'        => [ new Assert\NotBlank() ],
            'footage'           => [ new Assert\NotBlank() ],
            'rooms_number'      => [ new Assert\NotBlank() ],
            'clientId'          => [ new Assert\NotBlank() ],
            'contract_type'     => [ new Assert\NotBlank() ],
            'legal_status'      => [ new Assert\NotBlank() ],
            'market_type'       => [ new Assert\NotBlank() ],
            'offering_type'     => [ new Assert\NotBlank() ],
            'available_from'    => [ new Assert\NotBlank() ],
            'property_type'     => [ new Assert\NotBlank() ],
        ]);
    }

    private function getValidationGroups(): Assert\GroupSequence
    {
        return new Assert\GroupSequence(['Default', 'offer']);
    }
}
