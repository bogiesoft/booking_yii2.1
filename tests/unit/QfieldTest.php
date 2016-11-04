<?php
namespace tests;
use app\models\Qfield;

class QfieldTest extends \Codeception\Test\Unit
{
    public function testQfieldValidation()
    {
        $qfield = new Qfield;
        
        $qfield->id_tour = null;
        $this->assertFalse($qfield->validate(['id_tour']));
        
        $qfield->id_tour = "string";
        $this->assertFalse($qfield->validate(['id_tour']));
        
        $qfield->id_tour = 1;
        $this->assertTrue($qfield->validate(['id_tour']));
                
        $qfield->field_name = null;
        $this->assertFalse($qfield->validate(['field_name']));
        
        $qfield->field_name = 11;
        $this->assertFalse($qfield->validate(['field_name']));
        
        $qfield->field_name = "True field";
        $this->assertTrue($qfield->validate(['field_name']));
        
        $qfield->field_data = null;
        $this->assertFalse($qfield->validate(['field_data']));
        
        $qfield->field_data = 11;
        $this->assertFalse($qfield->validate(['field_data']));
        
        $qfield->field_data = "True data";
        $this->assertTrue($qfield->validate(['field_data']));
    }
    
    public function testSavingTour()
    {
        $qfield = new Qfield;
        $qfield->id_tour=1;
        $qfield->field_name='True field';
        $qfield->field_data='True data';
        $qfield->save();
        $this->assertEquals('True field', $qfield->field_name);
        $this->assertEquals('True data', $qfield->field_data);
    }
    
}