<?php

declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\CommandHandler;

use Gedmo\Sluggable\Util\Urlizer;
use RealDeal\SalesManagement\Application\Command\Offer\UploadOfferPhotoCommand;
use RealDeal\SalesManagement\Application\Repository\Offer\OfferRepository;
use RealDeal\SalesManagement\Domain\Offer\OfferPhoto;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadOfferPhotoHandler
{
    private OfferRepository $offerRepository;
    private Container $container;

    public function __construct(
        OfferRepository $offerRepository,
        Container $container
    ){
        $this->offerRepository = $offerRepository;
        $this->container = $container;
    }

    public function __invoke(UploadOfferPhotoCommand $command)
    {
        /** @var UploadedFile $photo */
        $photoFile = $command->getUploadedFile();
        $uploadPath = $this->container->getParameter('kernel.project_dir') . '/public/uploads';

        $photo = new OfferPhoto($uploadPath, $photoFile);
        $photo->setPhotoRole($command->getUploadedPhotoRole());

        $offer = $this->offerRepository->findById($command->getOfferId());
        $offer->addPhoto($photo);

        $this->offerRepository->save($offer);
    }
}
