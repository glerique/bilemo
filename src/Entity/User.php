<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(   
 *  collectionOperations={
 *          "get" = {"normalization_context"={"groups"="users:list"}}, 
 *          "post" = {"denormalization_context" ={"groups" = {"users:write"},
 *          "disable_type_enforcement"=true}}},
 *  itemOperations={
 *          "get"={"normalization_context"={"groups"="users:item"}},
 *          "delete"},
 *  attributes={
 *           "pagination_items_per_page"=10,
 *            "order": {"id":"desc"}} 
 * )
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email", message="Un autre utilisateur possède déjà cette adresse email")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"users:list", "users:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:list", "users:item", "users:write"})
     * @Assert\NotBlank(message="Le prénom est obligatoire")
     * @Assert\Length(
     *      min=3, 
     *      minMessage="Le prénom doit faire entre 3 et 255 caractères", 
     *      max=255, 
     *      maxMessage="Le prénom doit faire entre 3 et 255 caractères")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:list", "users:item", "users:write"})
     * @Assert\NotBlank(message="Le nom de famille est obligatoire")
     * @Assert\Length(
     *      min=3, 
     *      minMessage="Le nom de famille doit faire entre 3 et 255 caractères", 
     *      max=255, 
     *      maxMessage="Le nom de famille doit faire entre 3 et 255 caractères")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:item", "users:write"})
     * @Assert\NotBlank(message="L'adresse est obligatoire")
     * @Assert\Length(
     *      min=3, 
     *      minMessage="L'adresse doit faire entre 5 et 255 caractères", 
     *      max=255, 
     *      maxMessage="L'adresse doit faire entre 5 et 255 caractères")
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"users:item", "users:write"})
     * @Assert\NotBlank(message="Le code postal est obligatoire")
     * @Assert\Type(
     *      type="integer", 
     *      message="Le code postal est incorrect")
     * @Assert\Length(
     *      min="5",           
     *      max="5",     
     *      exactMessage="Le code postal est incorrect"
     * )
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:item", "users:write"})
     * @Assert\NotBlank(message="La ville est obligatoire")
     * @Assert\Length(
     *      min=3, 
     *      minMessage="La ville doit faire entre 2 et 255 caractères", 
     *      max=255, 
     *      maxMessage="La ville doit faire entre 2 et 255 caractères")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users:list", "users:item", "users:write"})
     * @Assert\NotBlank(message="L'email doit être renseigné !")
     * @Assert\Email(message="L'adresse email doit avoir un format valide !")
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="Users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"users:write"})
     * @Assert\NotBlank(message="Le numéro de client est obligatoire !")
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    public function setPostCode($postCode): self
    {
        $this->postCode = $postCode;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
