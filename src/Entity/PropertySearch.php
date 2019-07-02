<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{

    /**
    * @var int|null
     * @Assert\Range(min="0", max="50")
    */

    private $maxPrice;

    /**
     * @var int|null
     * @Assert\Range(min="1", max="4")
     */

    private $minSeats;

    /**
     * @return int|null
     */

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSeats(): ?int
    {
        return $this->minSeats;
    }

    /**
     * @param int|null $minSeats
     * @return PropertySearch
     */
    public function setMinSeats(int $minSeats): PropertySearch
    {
        $this->minSeats = $minSeats;
        return $this;
    }

}
