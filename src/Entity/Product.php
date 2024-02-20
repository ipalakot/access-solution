<?php

namespace App\Entity;

use App\Repository\ProductRepository;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ ORM\Entity( repositoryClass: ProductRepository::class ) ]

class Product {
    #[ ORM\Id ]
    #[ ORM\GeneratedValue ]
    #[ ORM\Column( type: 'integer' ) ]
    private ?int $id = null;

    #[ ORM\Column( type: 'string', length: 50 ) ]
    #[ Assert\NotBlank( message: 'this field is not empty' ) ]
    #[ Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    ) ]
    private ?string $title = null;

    #[ ORM\Column( type: Types::TEXT ) ]
    #[ Assert\NotBlank( message: 'this field is not empty' ) ]
    private ?string $description = null;

    #[ ORM\Column( type: 'string', length: 50 ) ]
    #[ Assert\NotBlank( message: 'this field is not empty' ) ]
    #[ Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'minimum size is {{ limit }} characters',
        maxMessage: 'maximum size is {{ limit }} characters',
    ) ]
    private ?string $brand = null;

    #[ ORM\Column( type: 'float' ) ]
    #[ Assert\NotBlank( message: 'this field is not empty' ) ]
    #[ Assert\Positive() ]
    #[ Assert\LessThan( 10000 ) ]
    private ?float $price;

    #[ ORM\Column( type: 'datetime_immutable' ) ]
    #[ Assert\NotNull() ]
    private ?\DateTimeImmutable $createdAt;

    #[ ORM\Column( type: 'datetime_immutable' ) ]
    #[ Assert\NotNull() ]
    private ?\DateTimeImmutable $updatedAt;

    #[ ORM\ManyToOne( inversedBy: 'products' ) ]
    #[ ORM\JoinColumn( nullable: false ) ]
    #[ Assert\NotBlank( message: 'this field is not empty' ) ]
    private ?Category $categoryShop = null;

    #[ ORM\OneToMany( mappedBy: 'product', targetEntity: Image::class, cascade: [ 'persist' ], orphanRemoval: true ) ]
    #[ Assert\NotBlank( message: 'this field is not empty' ) ]
    private Collection $imageShop;

    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
        $this->imageShop = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle( string $title ): static {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription( string $description ): static {
        $this->description = $description;

        return $this;
    }

    public function getBrand(): ?string {
        return $this->brand;
    }

    public function setBrand( string $brand ): static {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice( float $price ): static {
        $this->price = $price;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable {
        return $this->createdAt;
    }

    public function setCreatedAt( \DateTimeImmutable $createdAt ): static {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable {
        return $this->updatedAt;
    }

    public function setUpdatedAt( ?\DateTimeImmutable $updatedAt ): static {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategoryShop(): ?Category {
        return $this->categoryShop;
    }

    public function setCategoryShop( ?Category $categoryShop ): static {
        $this->categoryShop = $categoryShop;

        return $this;
    }

    /**
    * @return Collection<int, Image>
    */

    public function getImageShop(): Collection {
        return $this->imageShop;
    }

    public function addImageShop( Image $imageShop ): static {
        if ( !$this->imageShop->contains( $imageShop ) ) {
            $this->imageShop->add( $imageShop );
            $imageShop->setProduct( $this );
        }

        return $this;
    }

    public function removeImageShop( Image $imageShop ): static {
        if ( $this->imageShop->removeElement( $imageShop ) ) {
            // set the owning side to null ( unless already changed )
            if ( $imageShop->getProduct() === $this ) {
                $imageShop->setProduct( null );
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->title;
    }

}
