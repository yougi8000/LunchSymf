<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 */
class Restaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $design;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kitchen;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $platJour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dessert;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $drinks;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $promotion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $waste;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $openhours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryRestaurant::class, inversedBy="restaurants")
     */
    private $categoryRestaurant;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDesign(): ?string
    {
        return $this->design;
    }

    public function setDesign(string $design): self
    {
        $this->design = $design;

        return $this;
    }

    public function getKitchen(): ?string
    {
        return $this->kitchen;
    }

    public function setKitchen(string $kitchen): self
    {
        $this->kitchen = $kitchen;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPlatJour(): ?string
    {
        return $this->platJour;
    }

    public function setPlatJour(?string $platJour): self
    {
        $this->platJour = $platJour;

        return $this;
    }

    public function getEntree(): ?string
    {
        return $this->entree;
    }

    public function setEntree(?string $entree): self
    {
        $this->entree = $entree;

        return $this;
    }

    public function getPlat(): ?string
    {
        return $this->plat;
    }

    public function setPlat(?string $plat): self
    {
        $this->plat = $plat;

        return $this;
    }

    public function getDessert(): ?string
    {
        return $this->dessert;
    }

    public function setDessert(?string $dessert): self
    {
        $this->dessert = $dessert;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getDrinks(): ?string
    {
        return $this->drinks;
    }

    public function setDrinks(?string $drinks): self
    {
        $this->drinks = $drinks;

        return $this;
    }

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }

    public function setPromotion(?string $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getWaste(): ?string
    {
        return $this->waste;
    }

    public function setWaste(?string $waste): self
    {
        $this->waste = $waste;

        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(?string $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getOpenhours(): ?string
    {
        return $this->openhours;
    }

    public function setOpenhours(?string $openhours): self
    {
        $this->openhours = $openhours;

        return $this;
    }

    public function getProfile(): ?string
    {
        return $this->profile;
    }

    public function setProfile(?string $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getCategoryRestaurant(): ?CategoryRestaurant
    {
        return $this->categoryRestaurant;
    }

    public function setCategoryRestaurant(?CategoryRestaurant $categoryRestaurant): self
    {
        $this->categoryRestaurant = $categoryRestaurant;

        return $this;
    }

  
}
