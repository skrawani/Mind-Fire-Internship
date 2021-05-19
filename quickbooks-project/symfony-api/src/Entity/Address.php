<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="postalCode", type="integer", nullable=true)
     */
    private $postalcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line5", type="string", length=500, nullable=true)
     */
    private $line5;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line4", type="string", length=500, nullable=true)
     */
    private $line4;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line3", type="string", length=500, nullable=true)
     */
    private $line3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line2", type="string", length=500, nullable=true)
     */
    private $line2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="line1", type="string", length=500, nullable=true)
     */
    private $line1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="countrySubDivisionCode", type="string", length=255, nullable=true)
     */
    private $countrysubdivisioncode;


}
