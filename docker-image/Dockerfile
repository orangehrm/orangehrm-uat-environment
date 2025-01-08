FROM orangehrm/test-environment:rhel9-php8.2-latest

LABEL maintainer = "orangehrm"
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

ARG REDHAT_USERNAME
ARG REDHAT_PASSWORD

# Register a system with the Red Hat Customer Portal
RUN subscription-manager register --username $REDHAT_USERNAME --password $REDHAT_PASSWORD && \
subscription-manager refresh && \
subscription-manager attach --auto

# Our user in the container
USER root
WORKDIR /var/www/html/

RUN dnf -y install \
    rsyslog \
    openssh-server \
    openldap-clients \
    openldap \
    sudo \
    && dnf -y update bash \
    && rm -rf /var/cache/dnf/* \
    && dnf clean all

# Prerequisites to perform LDAP authentication in RHEL 8.
RUN dnf -y install sssd sssd-ldap oddjob-mkhomedir openssl-perl authselect

#Fix locale issue for SVN
RUN export LC_ALL=C
# Enable and configure sshd
#RUN mkdir /var/run/sshd

ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

EXPOSE 22


RUN mkdir /var/log/httpd/freehost /var/log/httpd/opensource /var/log/httpd/uat /var/log/httpd/test /var/log/httpd/prod

RUN httpd -S

RUN yes| rm /usr/lib/tmpfiles.d/systemd-nologin.conf
# Add supervisor conf
RUN mkdir -p /var/run/sshd
#ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf

#not - wanted
RUN systemctl enable systemd-user-sessions.service 

# Docker startup
#CMD ["/usr/bin/supervisord"]

#Installing telnet
RUN dnf install telnet -y

#Instlling Sendmail packages
RUN dnf install sendmail sendmail-cf m4 -y

# Unregister subscription
RUN subscription-manager unregister