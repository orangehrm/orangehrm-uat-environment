<?php


class PhpmyadminContainerCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }



    public function checkLoginToDBFromPhpmyadmin(AcceptanceTester $I){
        $I->wantTo("log into mysql 5.5 server through phpmyadmin");
        $I->amOnPage('http://localhost:9090');
        $I->fillField('Username:', 'root');
        $I->fillField('Password:', '1234');
        $I->click('Go');
        $I->see('Server: db');
        $I->see("Server version: 5.5");
    }

}
