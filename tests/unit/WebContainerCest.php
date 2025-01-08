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
        $I->runShellCommand("docker inspect -f {{.State.Running}} uat_web_rhel");
        $I->seeInShellOutput("true");
    }


    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 8.2 is installed in the container");
        $I->runShellCommand("docker exec uat_web_rhel php --version");
        $I->seeInShellOutput('PHP 8.2');
    }

    public function checkForNologinFile(UnitTester $I){
        $I->wantTo("verify nologin file is not there");
        $I->runShellCommand("docker exec uat_web_rhel ls /var/run/");
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
        $I->runShellCommand("docker exec uat_web_rhel systemctl status crond");
        $I->seeInShellOutput('active (running)');
    }

    // public function checkMemcacheServiceIsRunning(UnitTester $I){
    //     $I->wantTo("verify apache is up and running in the container");
    //     $I->runShellCommand("docker exec uat_web_rhel systemctl status memcached");
    //     $I->seeInShellOutput('active (running)');
    // }

    public function checkSSHInstallation(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep openssh-server");
            $I->seeInShellOutput("openssh-server-8");
    }

    public function checkSSHServiceRunning(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec uat_web_rhel systemctl status sshd");
            $I->seeInShellOutput('active (running)');
    }

    public function checkSSSDInstallation(UnitTester $I){
        $I->wantTo("verify sssd is installed in the container");
        $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep sssd");
        $I->seeInShellOutput('sssd-2');
    }

    // public function checkSSSDServiceRunning(UnitTester $I){
    //     $I->wantTo("verify sssd is up and running in the container");
    //     $I->runShellCommand("docker exec uat_web_rhel systemctl status sssd");
    //     $I->seeInShellOutput('active (running)');
    // }

    public function checkOddJobMkHomeDirInstallation(UnitTester $I){
            $I->wantTo("verify oddjob-mkhomedir is installed in the container");
            $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep oddjob-mkhomedir");
            $I->seeInShellOutput("oddjob-mkhomedir-0");
    }

    public function checkOpenldapInstallation(UnitTester $I){
            $I->wantTo("verify open-ldap is installed in the container");
            $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep openldap");
            $I->seeInShellOutput("openldap-clients-2");
    }

    public function checkOpensslPerlInstallation(UnitTester $I){
        $I->wantTo("verify openssl-perl is installed in the container");
        $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep openssl-perl");
        $I->seeInShellOutput("openssl-perl");
    }

    // public function checkNSCDInstallation(UnitTester $I){
    //         $I->wantTo("verify nscd is installed in the container");
    //         $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep nscd");
    //         $I->seeInShellOutput("nscd-2");
    // }

    public function checkJavaVersion(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep java");
            $I->seeInShellOutput("openjdk");
    }

    public function checkWgetVersion(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec uat_web_rhel rpm -qa | grep wget");
            $I->seeInShellOutput("wget-1");
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
        $I->wantTo("verify whether sendmail noarch is installed");
        $I->runShellCommand("docker exec uat_web_rhel dnf list installed | grep sendmail");
        $I->seeInShellOutput("sendmail-cf.noarch");
    }

}
