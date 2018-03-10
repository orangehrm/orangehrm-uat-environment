<?php


class UATEnvironmentForOSCest
{


    public function installApp(AcceptanceTester $I)
    {
        $I->comment("Cloning project into /var/www/html");

        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting && git clone https://github.com/orangehrm/orangehrm.git "');
        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting/orangehrm && bash fix_permissions.sh"');
        $I->runShellCommand('docker exec infinity_web bash -c "yes | cp -rf config.ini OpenSourceFreeHosting/orangehrm/installer/config.ini"');
        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting/orangehrm; composer install -d symfony/lib"');
        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting/orangehrm/symfony; php symfony cc"');
        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting/orangehrm; php installer/cli_install.php 0"');
        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting/orangehrm/symfony; php symfony o:publish-assets"');
        $I->runShellCommand('docker exec infinity_web bash -c "cd OpenSourceFreeHosting/orangehrm/symfony; php symfony d:build-model"');
        $I->runShellCommand('docker exec infinity_web chmod 777 -R /var/www/html');
    }



//    public function testValidCredentials(AcceptanceTester $I)
//    {
//        $I->am('ohrm user');
//        $I->wantTo('Login to application as admin');
//        $I->lookForwardTo('access to orangehrm application');
//        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
//        $I->fillField('txtUsername', 'Admin');
//        $I->fillField('txtPassword', 'admin');
//        $I->click('Submit');
//        $I->see('Dashboard');
//    }
////    public function checkOrangeHRMOSApp(AcceptanceTester $I){
////        $I->wantTo("verify uat environment is working properly with orangehrm opensource app");
////        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
////        $I->see("internal error");
////    }
//
//    /**
//     *
//     * @example{"empname":"testemp1","user":"testuser1","pword":"12345","role":"1"}
//     * @example{"empname":"testemp2","user":"testuser2","pword":"12345","role":"2"}
//     * @example{"empname":"testemp3","user":"testuser3","pword":"12345","role":"2"}
//     *
//     * */
//
//
//    public function testAddUserInOHRMApp( AcceptanceTester $I, \Codeception\Example $example)
//    {
//        $I->am('ohrm user');
//        $I->wantTo('check add user functionality');
//        $I->lookForwardTo('access to orangehrm application and add 3 ess users');
//        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
//        $I->fillField('txtUsername','admin');
//        $I->fillField('txtPassword','admin');
//        $I->click('Submit');
//        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm/symfony/web/index.php/pim/addEmployee');
//        $I->fillField('firstName',$example['empname']);
//        $I->fillField('lastName',$example['empname']);
//        $I->checkOption('Create Login Details');
//        $I->fillField('User Name',$example['user']);
//        $I->fillField('Password',$example['pword']);
//        $I->fillField('Confirm Password',$example['pword']);
//
//        $I->click('btnSave');
//
//        $I->see($example['empname']+' '+$example['empname']);
//    }
//
//    /**
//     *
//     * @example{"empname":"testemp1","user":"testuser1","pword":"12345"}
//     * @example{"empname":"testemp2","user":"testuser2","pword":"12345"}
//     * @example{"empname":"testemp3","user":"testuser3","pword":"12345"}
//     *
//     * */
//
//    public function testLoginWithNewUsersInOHRMApp(AcceptanceTester $I, \Codeception\Example $example)
//    {
//        $I->am('ohrm user');
//        $I->wantTo('check login with new users');
//        $I->lookForwardTo('access to orangehrm application using credentials of new users');
//        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
//        $I->fillField('txtUsername', $example['user']);
//        $I->fillField('txtPassword', $example['pword']);
//        $I->click('Submit');
//        $I->see('Dashboard');
//    }
//
////    public function addLeavePeriod(AcceptanceTester $I)
////    {
////        $I->am('ohrm user');
////        $I->wantTo('add leave period');
////        $I->lookForwardTo('set leave period for whole year');
////        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
////        $I->fillField('txtUsername', 'Admin');
////        $I->fillField('txtPassword', 'admin');
////        $I->click('Submit');
////        $I->see('Dashboard');
////        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm/symfony/web/index.php/leave/defineLeavePeriod');
////        $I->selectOption('leaveperiod[cmbStartMonth]', '1');
////        $I->selectOption('Start Date ', '1');
////        $I->click('btnEdit');
////
////
////    }
//
//    public function addLeaveType(AcceptanceTester $I)
//    {
//        $I->am('ohrm user');
//        $I->wantTo('add leave types');
//        $I->lookForwardTo('add new casual leave type');
//        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
//        $I->fillField('txtUsername', 'Admin');
//        $I->fillField('txtPassword', 'admin');
//        $I->click('Submit');
//        $I->see('Dashboard');
//        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm/symfony/web/index.php/leave/defineLeaveType');
//        $I->fillField('leaveType[txtLeaveTypeName]', 'casual');
//        $I->click('saveButton');
//
//
//    }
//
////    public function addEntailments(AcceptanceTester $I)
////    {
////        $I->am('ohrm user');
////        $I->wantTo('add leave to a user');
////        $I->lookForwardTo('add leave to a user');
////        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm');
////        $I->fillField('txtUsername', 'Admin');
////        $I->fillField('txtPassword', 'admin');
////        $I->click('Submit');
////        $I->see('Dashboard');
////        $I->amOnPage('https://localhost:6868/OpenSourceFreeHosting/orangehrm/symfony/web/index.php/leave/addLeaveEntitlement');
////        $I->fillField('#entitlements_employee_empId', 'testemp1');
////        $I->fillField('entitlements[entitlement]', 'annual');
////        $I->click('btnSave');
////
////
////    }


    public function cleanup(AcceptanceTester $I)
    {
        $I->comment("remove the project directory from /var/www/html");
        $I->runShellCommand('docker exec infinity_web rm -rf OpenSourceFreeHosting/orangehrm');
        $I->runShellCommand('docker exec infinity_web rm config.ini');
    }


}
