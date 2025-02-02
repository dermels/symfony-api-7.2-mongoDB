<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Serializer\Annotation\Groups;

#[MongoDB\Document]
class Product
{
    #[MongoDB\Id]
    #[Groups(['product:read'])]
    private $id;

    #[MongoDB\Field(type: "string")]
    #[Groups(['product:read', 'product:write'])]
    private $name;

    #[MongoDB\Field(type: "float")]
    #[Groups(['product:read', 'product:write'])]
    private $price;

    public function getId(): ?string
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}