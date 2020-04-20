FROM orangehrm/orangehrm-environment-images:test-7.4-remi

MAINTAINER orangehrm
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

# Our user in the container
USER root
WORKDIR /var/www/html/


RUN yum -y install \
    authconfig \
    nscd \
    rsyslog \
    nss-pam-ldapd \
    openssh-server \
    openldap-clients \
    openldap \
    sudo \
    wget \
    cyrus-sasl-plain \
    urw-fonts.noarch \
    && yum -y update bash \
    && rm -rf /var/cache/yum/* \
    && yum clean all


#Fix locale issue for SVN
RUN export LC_ALL=C
# Enable and configure sshd
#RUN mkdir /var/run/sshd

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd
ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

#default ssh user orangehrm with password "password"
RUN useradd -ms /bin/bash -p sa3tHJ3/KuYvI orangehrm
RUN echo "root:root" | chpasswd

RUN authconfig --enableforcelegacy --update
RUN authconfig --enableldap --enableldapauth --enablemkhomedir --enablepamacces --ldapserver="ldaps://ldap.orangehrm.com ldaps://ldap-slave.orangehrm.com" \
    --ldapbasedn="dc=orangehrm,dc=com" --update

EXPOSE 22


RUN mkdir /var/log/httpd/freehost /var/log/httpd/opensource /var/log/httpd/uat /var/log/httpd/test /var/log/httpd/prod

RUN httpd -S

RUN yes| rm /usr/lib/tmpfiles.d/systemd-nologin.conf
# Add supervisor conf
RUN mkdir -p /var/run/sshd
#ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN systemctl enable nslcd.service
RUN systemctl enable systemd-user-sessions.service
# Docker startup
#CMD ["/usr/bin/supervisord"]

#Installing telnet
RUN yum install telnet -y

#Instlling Sendmail packages
RUN yum install sendmail sendmail-cf m4 -y