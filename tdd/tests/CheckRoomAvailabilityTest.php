<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Room;
use App\Entity\User;
use App\Entity\Booking;
use DateTime;

class CheckRoomAvailabilityTest extends TestCase
{
    private function dataProviderForPremiumRoom() : array
    {
        return [
            [true, true, true],
            [false, false, true],
            [false, true, true],
            [true, false, false]
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForPremiumRoom
     */
    public function testPremiumRoom(bool $roomVar, bool $userVar, bool $expectedOutput): void
     {
        $room = new Room($roomVar);
        $user = new User($userVar);

        $this->assertEquals($expectedOutput, $room->canBook($user));
    }


    private function dataProviderForbookings(): array
    {
        return [
            [new DateTime("2020-01-12 05:12:30"), new DateTime("2020-01-12 05:40:30"), true],
            [new DateTime("2020-01-12 05:12:30"), new DateTime("2020-01-12 10:12:30"), false],
            [new DateTime("2020-01-12 06:12:30"), new DateTime("2020-01-12 10:12:30"), true],
            [new DateTime("2020-01-12 05:12:30"), new DateTime("2020-01-12 10:11:30"), false],


        ];
    }
    /**
     * function has to start with Test
     * @dataProvider dataProviderForbookings
     */
    public function testBookings(DateTime $Startdate, DateTime $Enddate,bool $expectedOutput): void
    {
        $bookings = new Booking();
        $this->assertEquals($expectedOutput, $bookings->canBook($Startdate, $Enddate));

    }
    public function dataProviderCanAfford(): array
    {
        return [
            [new User(1), 100 , 3 , true],
            [new User(1),50,4, false],
            [new User(1),150,3, true],
            [new User(1),20,5,false]
        ];
    }
    /**
     * function has to start with Test
     * @dataProvider dataProviderCanAfford
     */
    public function canAfford(User $user, int $credit, int $bookings, bool $expectedOutput): void
    {
        $user = new User(1);
        $user->setCredit(1);
        $this->assertEquals($expectedOutput, $user->canAfford($user, $bookings));

    }
    function dataProviderForIsAvailable(): array
    {
        return [
            [new DateTime("2018-01-10 12:00:45"), new DateTime("2018-01-10 14:00:45"), [
                ['Startdate' => new DateTime("2018-01-10 02:00:45"), 'Enddate' => new DateTime("2018-01-10 06:00:45")],
                ['Startdate' => new DateTime("2018-01-10 12:00:45"), 'Enddate' => new DateTime("2018-01-10 13:00:45")],
                ['Startdate' => new DateTime("2018-01-10 14:00:45"), 'Enddate' => new DateTime("2018-01-10 16:00:45")],
            ], false],
            [new DateTime("2018-01-10 12:00:45"), new DateTime("2018-01-10 14:00:45"), [
                ['Startdate' => new DateTime("2018-01-10 08:00:45"), 'Enddate' => new DateTime("2018-01-10 12:00:45")],
                ['Startdate' => new DateTime("2018-01-10 08:00:45"), 'Enddate' => new DateTime("2018-01-10 10:00:45")],
                ['Startdate' => new DateTime("2018-01-10 14:00:45"), 'Enddate' => new DateTime("2018-01-10 19:00:45")],
            ], true],
            [new DateTime("2018-01-10 15:00:45"), new DateTime("2018-01-10 19:00:45"), [
                ['Startdate' => new DateTime("2018-01-10 12:00:45"), 'Enddate' => new DateTime("2018-01-10 15:00:45")],
                ['Startdate' => new DateTime("2018-01-10 11:00:45"), 'Enddate' => new DateTime("2018-01-10 12:00:45")],
                ['Startdate' => new DateTime("2018-01-10 11:00:45"), 'Enddate' => new DateTime("2018-01-10 14:00:45")],
            ], true],
            [new DateTime("2018-01-10 10:00:45"), new DateTime("2018-01-10 14:00:45"), [
                ['Startdate' => new DateTime("2018-01-10 02:00:45"), 'Enddate' => new DateTime("2018-01-10 02:00:45")],
                ['Startdate' => new DateTime("2018-01-10 02:00:45"), 'Enddate' => new DateTime("2018-01-10 02:00:45")],
                ['Startdate' => new DateTime("2018-01-10 12:00:45"), 'Enddate' => new DateTime("2018-01-10 13:00:45")],
            ], false],
        ];
    }

    /**
     * function has to start with Test
     * @dataProvider dataProviderForIsAvailable
     */
    public function testIsAvailable(DateTime $Startdate, DateTime $Enddate, bool $expectedOutput): void
    {
        $booking = new Booking();
        $this->assertEquals($expectedOutput, $booking->checkAvailability($Startdate, $Enddate));
    }
}
