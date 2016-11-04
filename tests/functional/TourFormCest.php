<?php
class TourFormCest 
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['tour/create']);
    }

    public function openTourCreatePage(\FunctionalTester $I)
    {
        $I->see('Create Tour', 'h1');        
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#dynamic-form', []);
        $I->expectTo('see validations errors');
        $I->see('Create Tour', 'h1');
        $I->see('Name cannot be blank');
    }

    public function submitFormWithIncorrectQuality(\FunctionalTester $I)
    {
        $I->submitForm('#dynamic-form', [
            'DynamicForm[name]' => "Tourname",
            'DynamicForm[adult_q]' => "sdsd",
            'DynamicForm[child_q]' => 0,
            'DynamicForm[baby_q]' => 2,
        ]);
        $I->expectTo('see that Adult Q is wrong');
        $I->dontSee('Name cannot be blank', '.help-inline');
        $I->see('Adult Q must be an integer.');
        $I->dontSee('Field_name cannot be blank', '.help-inline');  
        $I->dontSee('Field_data cannot be blank', '.help-inline');  
    }

    public function submitTourSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#dynamic-form', [
            'DynamicForm[name]' => 'Tourname',
            'DynamicForm[adult_q]' => 4,
            'DynamicForm[child_q]' => 0,
            'DynamicForm[baby_q]' => 2
        ]);
    }
}
