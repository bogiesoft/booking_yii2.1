<?php
namespace tests;
use app\models\Booking;

class BookingTest extends \Codeception\Test\Unit
{
    public function testTourValidation()
    {
        $booking = new Booking;
        
        $booking->id_user = null;
        $this->assertFalse($booking->validate(['id_user']));
        
        $booking->id_user = 1;
        $this->assertTrue($booking->validate(['id_user']));
        
        $booking->id_tour = null;
        $this->assertFalse($booking->validate(['id_tour']));
        
        $booking->id_tour = 2;
        $this->assertTrue($booking->validate(['id_tour']));
        
        $booking->id_user = "string";
        $this->assertFalse($booking->validate(['id_user']));
     
        $booking->id_tour = "string";
        $this->assertFalse($booking->validate(['id_tour']));
        
        $booking->date_tour = 10;
        $this->assertFalse($booking->validate(['date_tour']));
        
        $booking->date_tour = "2016-12-12";
        $this->assertTrue($booking->validate(['date_tour']));
    }
    
    public function testSavingTour()
    {
        $booking = new Booking;
        
        $booking->id_user=12;
        $booking->id_tour=2;
        $booking->date_tour="2017-12-12";
        $booking->save();
        $this->assertEquals("2017-12-12", $booking->date_tour);
    }
    
    
     public function testFindTours()
    {
        $booking=Booking::findOne(1);
        $this->assertTrue($booking->tours!=null); 
    }
}