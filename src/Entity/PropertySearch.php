<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     */

    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

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

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     * @return PropertySearch
     */
    public function setOptions(ArrayCollection $options): PropertySearch
    {
        $this->options = $options;
        return $this;
    }

}
