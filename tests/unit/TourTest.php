<?php
namespace tests;
use app\models\Tour;

class TourTest extends \Codeception\Test\Unit
{
    public function testTourValidation()
    {
        $tour = new Tour;
        
        $tour->name = null;
        $this->assertFalse($tour->validate(['name']));
        
        $tour->name = 11;
        $this->assertFalse($tour->validate(['name']));
        
        $tour->name = "Good tour";
        $this->assertTrue($tour->validate(['name']));
        
        $tour->adult_q = "string";
        $this->assertFalse($tour->validate(['adult_q']));
        
        $tour->adult_q = 1;
        $this->assertTrue($tour->validate(['adult_q']));
     
        $tour->child_q = "string";
        $this->assertFalse($tour->validate(['child_q']));
        
        $tour->child_q = 2;
        $this->assertTrue($tour->validate(['child_q']));
        
        $tour->baby_q = 10;
        $this->assertFalse($tour->validate(['baby_q']));
        
        $tour->baby_q = 3;
        $this->assertTrue($tour->validate(['baby_q']));
    }
    
    public function testSavingTour()
    {
        $tour = new Tour;
        
        $tour->name='Best tour 2016';
        $tour->adult_q=2;
        $tour->save();
        $this->assertEquals('Best tour 2016', $tour->name);
    }
    
    
     public function testFindQfields()
    {
        $tour=Tour::findOne(31);
        $this->assertTrue($tour->qfields!=null); 
    }
}