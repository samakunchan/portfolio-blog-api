<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait Timestapable
{
    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\Type("datetime")]
    private ?DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\Type("datetime")]
    private ?DateTimeInterface $updatedAt;

    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
