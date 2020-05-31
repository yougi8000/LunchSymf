<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=CategoryRestaurant::class, mappedBy="category")
     */
    private $restaurant;

    public function __construct()
    {
        $this->restaurant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|CategoryRestaurant[]
     */
    public function getRestaurant(): Collection
    {
        return $this->restaurant;
    }

    public function addRestaurant(CategoryRestaurant $restaurant): self
    {
        if (!$this->restaurant->contains($restaurant)) {
            $this->restaurant[] = $restaurant;
            $restaurant->setCategory($this);
        }

        return $this;
    }

    public function removeRestaurant(CategoryRestaurant $restaurant): self
    {
        if ($this->restaurant->contains($restaurant)) {
            $this->restaurant->removeElement($restaurant);
            // set the owning side to null (unless already changed)
            if ($restaurant->getCategory() === $this) {
                $restaurant->setCategory(null);
            }
        }

        return $this;
    }
}
