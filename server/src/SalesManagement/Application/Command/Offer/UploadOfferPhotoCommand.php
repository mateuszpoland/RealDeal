<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command\Offer;

use RealDeal\SalesManagement\Domain\Offer\OfferPhoto;
use RealDeal\Shared\Application\CommandInterface;

class UploadOfferPhotoCommand implements CommandInterface
{
    private int $offerId;
    private UploadedFile $uploadedFile;
    private string $uploadedPhotoRole;

    public function __toString(): string
    {
        return get_class($this);
    }

    public function __construct(
        int $offerId,
        UploadedFile $uploadedFile,
        $uploadedPhotoRole=OfferPhoto::PHOTO_SIDE
    ){
        $this->uploadedFile = $uploadedFile;
        $this->offerId = $offerId;
        $this->uploadedPhotoRole = $uploadedPhotoRole;
    }

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getUploadedFile(): UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @return string
     */
    public function getUploadedPhotoRole(): string
    {
        return $this->uploadedPhotoRole;
    }
}
