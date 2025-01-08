<?php


class WebContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

  public function checkContainerIsRunning(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} uat_web_ubuntu");
        $I->seeInShellOutput("true");
    }


    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 8.3 is installed in the container");
        $I->runShellCommand("docker exec uat_web_ubuntu php --version");
        $I->seeInShellOutput('PHP 8.3');
    }

    public function checkForNologinFile(UnitTester $I){
        $I->wantTo("verify nologin file is not there");
        $I->runShellCommand("docker exec uat_web_ubuntu ls /var/run/");
        $I->dontSeeInShellOutput("nologin");
    }

//    public function checkApacheServiceIsRunning(UnitTester $I){
//        $I->wantTo("verify apache is up and running in the container");
//        $I->runShellCommand("ping -c 10 localhost");
//        $I->runShellCommand("docker exec infinity_web service httpd status");
//        $I->seeInShellOutput('active (running)');
//    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec uat_web_ubuntu service cron status");
        $I->seeInShellOutput('cron is running');
    }

    // public function checkMemcacheServiceIsRunning(UnitTester $I){
    //     $I->wantTo("verify apache is up and running in the container");
    //     $I->runShellCommand("docker exec uat_web_ubuntu service memcached status");
    //     $I->seeInShellOutput('active (running)');
    // }

    public function checkSSHInstallation(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec uat_web_ubuntu apt list --installed | grep openssh-server");
            $I->seeInShellOutput("openssh-server");
    }

    public function checkSSHServiceRunning(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec uat_web_ubuntu service ssh status");
            $I->seeInShellOutput('sshd is running');
    }

    // public function checkNSSPAMLDAPInstallation(UnitTester $I){
    //         $I->wantTo("verify nss-pam-ldapd is installed in the container");
    //         $I->runShellCommand("docker exec uat_web_ubuntu rpm -qa | grep nss-pam-ldapd");
    //         $I->seeInShellOutput("nss-pam-ldapd-0.8");
    // }

    public function checkOpenldapInstallation(UnitTester $I){
            $I->wantTo("verify open-ldap is installed in the container");
            $I->runShellCommand("docker exec uat_web_ubuntu apt list --installed | grep ldap");
            $I->seeInShellOutput("ldap-utils");
    }

    public function checkNSCDInstallation(UnitTester $I){
            $I->wantTo("verify sssd is installed in the container");
            $I->runShellCommand("docker exec uat_web_ubuntu apt list --installed | grep sssd");
            $I->seeInShellOutput("sssd");
    }

    public function checkJavaVersion(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec uat_web_ubuntu java --version ");
            $I->seeInShellOutput("openjdk");
    }

    public function checkWgetVersion(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec uat_web_ubuntu apt list --installed | grep wget");
            $I->seeInShellOutput("wget");
    }
//    public function checkVHostConfig(UnitTester $I){
//        $I->wantTo("verify test vhost is configured in the container");
//        $I->runShellCommand("docker exec infinity_web httpd -S");
//        $I->seeInShellOutput("*-test-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-uat-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-prod-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-os-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-freehost-infinity.orangehrm.com");
//    }


    public function checkSendMailNoArch(UnitTester $I){
        $I->wantTo("verify wether sendmail noarch is installed");
        $I->runShellCommand("docker exec uat_web_ubuntu apt list --installed | grep sendmail");
        $I->seeInShellOutput("sendmail");
    }

}
