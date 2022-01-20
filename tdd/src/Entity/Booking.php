<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use DateTimeInterface;


#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $room;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $startDate;

    #[ORM\Column(type: 'datetime')]
    private $enddate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEnddate(): ?\DateTimeInterface
    {
        return $this->enddate;
    }

    public function setEnddate(\DateTimeInterface $enddate): self
    {
        $this->enddate = $enddate;

        return $this;
    }

    public function canBook(DateTime $Startdate, DateTime $Enddate) {

        $time_diff = $Startdate->diff($Enddate);
        $time_diff->h . ' hours';
        $time_diff->i . ' minutes';
        $time_diff->s . ' seconds';

        if($time_diff->i >0 && $time_diff->h==4){
            return false;
        }
        elseif ($time_diff->h == 4 ||  $time_diff->h < 4 ) {
            return true;
        }

           else {
               return false;
           }

    }
    public function checkAvailability(DateTime $startdate, DateTime $enddate)
    {
        return ($this->getStartDate() >= $startdate->getEndate() && $this->getStartDate() <= $enddate->getStartDate());
    }

}
