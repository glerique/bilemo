<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      collectionOperations={"get"={"normalization_context"={"groups"="products:list"}}},
 *      itemOperations={"get"={"normalization_context"={"groups"="products:item"}}},
 * attributes={
 *      "pagination_items_per_page"=10,
 *      "order": {"createdAt":"desc"}
 *  }
 * )
 * 
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"products:list", "products:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products:list", "products:item"})
     */
    private $model;

    /**
     * @ORM\Column(type="text")
     * @Groups({"products:item"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"products:item"})
     */
    private $color;

    /**
     * @ORM\Column(type="float")
     * @Groups({"products:item"})
     */
    private $screenSize;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"products:item"})
     */
    private $storage;

    /**
     * @ORM\Column(type="float")
     * @Groups({"products:item"})
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"products:item"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Client::class, mappedBy="products")
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getScreenSize(): ?float
    {
        return $this->screenSize;
    }

    public function setScreenSize(float $screenSize): self
    {
        $this->screenSize = $screenSize;

        return $this;
    }

    public function getStorage(): ?int
    {
        return $this->storage;
    }

    public function setStorage(int $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->addProduct($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            $client->removeProduct($this);
        }

        return $this;
    }
}
