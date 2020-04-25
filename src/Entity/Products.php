<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
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
    private $product_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prod_desc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prod_cost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductTitle(): ?string
    {
        return $this->product_title;
    }

    public function setProductTitle(?string $product_title): self
    {
        $this->product_title = $product_title;

        return $this;
    }

    public function getProdDesc(): ?string
    {
        return $this->prod_desc;
    }

    public function setProdDesc(?string $prod_desc): self
    {
        $this->prod_desc = $prod_desc;

        return $this;
    }

    public function getProdCost(): ?string
    {
        return $this->prod_cost;
    }

    public function setProdCost(string $prod_cost): self
    {
        $this->prod_cost = $prod_cost;

        return $this;
    }

    
}
