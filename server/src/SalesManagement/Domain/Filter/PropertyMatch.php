<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Filter\PropertyMatchRepository")
 */
class PropertyMatch
{
    private float$matchPercent;

    public function __construct()
    {

    }
}
