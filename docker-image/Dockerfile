FROM orangehrm/orangehrm-environment-images:test-7.4-ubuntu-20.04

MAINTAINER orangehrm
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

# Our user in the container
USER root
WORKDIR /var/www/html/

# Enable apache mods.
RUN a2enmod  vhost_alias

#configure 
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
    nscd \
    rsyslog \
    libnss-ldapd \
    libpam-ldap \
    ldap-utils \
    sudo \
    wget \
    cyrus-sasl2-doc \
    fonts-urw-base35 \
    && apt-get install --only-upgrade bash \
    && apt-get clean \
    && apt-get autoclean \

#Fix locale issue for SVN
RUN export LC_ALL=C

# Enable and configure sshd
RUN mkdir /var/run/sshd

# SSH login fix. Otherwise user is kicked off after login
COPY sshd.conf /etc/pam.d/sshd
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd
ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

#default ssh user orangehrm with password "password"
RUN useradd -ms /bin/bash -p sa3tHJ3/KuYvI orangehrm
RUN echo "root:root" | chpasswd

# Tidy up the container
RUN DEBIAN_FRONTEND=noninteractive apt-get purge -y \
    build-essential \
    libz-dev \
    && DEBIAN_FRONTEND=noninteractive apt-get -y autoremove  \
    && apt-get clean  \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Enable virtual hosts
RUN a2ensite orangehrm.conf

EXPOSE 22

RUN mkdir /var/log/apache2/freehost /var/log/apache2/opensource /var/log/apache2/uat /var/log/apache2/test /var/log/apache2/prod

#rectify the DefaultRuntimeDir error
RUN source /etc/apache2/envvars


RUN yes| rm /usr/lib/tmpfiles.d/systemd-nologin.conf

# Add supervisor conf
RUN mkdir -p /var/run/sshd
#ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN systemctl enable nslcd.service
RUN systemctl enable systemd-user-sessions.service
# Docker startup
#CMD ["/usr/bin/supervisord"]

#Installing telnet
RUN apt-get update 
RUN apt-get install telnet

#Instlling Sendmail packages
RUN apt-get install -y sendmail

#Enable Mod expires module
RUN a2enmod headers
RUN a2enmod expires

#restart apache
RUN service apache2 restart