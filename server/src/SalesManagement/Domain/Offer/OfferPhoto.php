<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use RealDeal\SalesManagement\Domain\Offer\Offer;

/**
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Offer\OfferPhotosRepository")
 * @ORM\Table(name="offer_photos", indexes={@ORM\Index(name="name_idx", columns={"file_path"})})
 * @ORM\HasLifecycleCallbacks
 */
class OfferPhoto
{
    public const MAIN_PHOTO = 'MAIN_PHOTO';
    public const SIDE_PHOTO = 'SIDE_PHOTO';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\File(maxSize=6000000)
     */
    private $file;

    /**
     * @var string
     * @ORM\Column(type="string", name="file_path", unique=true)
     */
    private $savedFilePath;

    private $tempFilePath;

    private $uploadRootDir;

    /**
     * @ORM\ManyToOne(targetEntity="Offer", inversedBy="offerPhotos")
     */
    private $offer;

    /**
     * @var string
     * @ORM\Column(type="string", unique=false)
     */
    private $originalFileName;

    /**
     * @var string
     * @ORM\Column(type="string", unique=false)
     */
    private $savedFileName;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $photoRole;

    public function __construct(string $uploadRootDir, UploadedFile $uploadedFile)
    {
        $this->uploadRootDir = $uploadRootDir;
        $this->setFile($uploadedFile);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
        if (isset($this->filePath)) {
            // store the old name to delete after the update
            $this->tempFilePath = $this->savedFilePath;
            $this->savedFilePath = null;
        } else {
            $this->savedFilePath = 'initial';
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getSavedFilePath(): string
    {
        return $this->savedFilePath;
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    public function setOffer(Offer $offer): void
    {
        $this->offer = $offer;
    }

    /**
     * @return string
     */
    public function getOriginalFileName(): string
    {
        return $this->originalFileName;
    }

    /**
     * @param string $originalFileName
     */
    public function setOriginalFileName(string $originalFileName): void
    {
        $this->originalFileName = $originalFileName;
    }

    /**
     * @return string
     */
    public function getSavedFileName(): string
    {
        return $this->savedFileName;
    }

    /**
     * @param string $savedFileName
     */
    public function setSavedFileName(string $savedFileName): void
    {
        $this->savedFileName = $savedFileName;
    }

    /**
     * @return string
     */
    public function getPhotoRole(): string
    {
        return $this->photoRole;
    }

    /**
     * @param string $photoStatus
     */
    public function setPhotoRole(string $photoRole): void
    {
        $this->photoRole = $photoRole;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload(): void
    {
        if($this->file) {
            $originalFileName = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
            $this->originalFileName = $originalFileName;
            $savedFilename = Urlizer::urlize(uniqid('_photo', true) .
                $this->originalFileName .
                '.' .
                $this->file->guessExtension());

            $this->savedFilePath = $savedFilename;
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload(): void
    {
        if(!$this->getFile()) {
            return;
        }
        $this->getFile()->move($this->uploadRootDir, $this->savedFilePath);
        $this->detachFile();
    }

    private function detachFile(): void
    {
        if (isset($this->tempFilePath)) {
            // delete the old image
            unlink($this->uploadRootDir .'/'.$this->tempFilePath);
            // clear the temp image path
            $this->tempFilePath = null;
        }

        $this->file = null;
    }
}
