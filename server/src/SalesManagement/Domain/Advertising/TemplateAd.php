<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Advertising;

use RealDeal\SalesManagement\Domain\Advertising\Advertising;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TemplateAd
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Domain\Repository\Advertising\AdvertisingRepository")
 */
class TemplateAd extends Advertising
{
}