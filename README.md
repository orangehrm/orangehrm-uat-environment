# orangehrm-uat-environment
[![Build Status](https://travis-ci.org/orangehrm/orangehrm-uat-environment.svg?branch=master)](https://travis-ci.org/orangehrm/orangehrm-uat-environment)
## Introduction
orangehrm-uat-environment is a dockerized uat environment for OrangeHRM. Usually it will take hours to configure and prepare the uat environment for orangehrm system. This project will save the techops engineers time.

This environment will depends on containers of [orangehrm-uat-image](https://hub.docker.com/r/orangehrm/orangehrm-environment-images) and [mysql](https://hub.docker.com/_/mysql/).
## Prerequisites
- Docker engine installed.([Get docker](https://docs.docker.com/engine/installation/))
- Minimum docker version 1.12
- Minimum docker-compose vsersion 1.9 
- Disable ports 80 and 443 if they are used by localhost.
