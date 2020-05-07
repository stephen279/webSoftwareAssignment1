<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
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
    private $productsordered;

      /**
     * @ORM\Column(type="string", length=255)
     */
    private $totalcost;

  /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

  /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;


    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductsordered(): ?string
    {
        return $this->productsordered;
    }

    public function setProductsordered(string $productsordered): self
    {
        $this->productsordered = $productsordered;

        return $this;
    }

    public function getTotalcost(): ?string
    {
        return $this->totalcost;
    }

    public function setTotalcost(string $totalcost): self
    {
        $this->productsordered = $productsordered;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

}
