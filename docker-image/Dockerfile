FROM orangehrm/orangehrm-environment-images:dev-7.0-centos

MAINTAINER orangehrm
LABEL authors = "Ridwan Shariffdeen <ridwan@orangehrmlive.com> , Thulana Kannangara <thulana@orangehrm.us.com>"

# Our user in the container
USER root
WORKDIR /var/www/html/


#Install dependent software
#RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y  --no-install-recommends --force-yes \
#  libnss-ldap \
#  libpam-ldap \
#  libz-dev \
#  nscd \
#  openjdk-7-jre \
#  openssh-server \
#  sudo \
#  wget

RUN yum -y install \
    openssh-server \
    sudo \
    wget \
    sudo \
    nscd \
    openldap \
    authconfig \
    openldap-clients \
    nss-pam-ldapd \
    && yum -y update bash \
    && rm -rf /var/cache/yum/* \
    && yum clean all


#Fix locale issue for SVN
RUN export LC_ALL=C
# Enable and configure sshd
RUN mkdir /var/run/sshd

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd
ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

#default ssh user orangehrm with password "password"
RUN useradd -ms /bin/bash -p sa3tHJ3/KuYvI orangehrm
RUN echo "root:root" | chpasswd

RUN authconfig --enableforcelegacy --update
RUN authconfig --enableldap --enableldapauth --ldapserver="instructor.example.com" \
    --ldapbasedn="dc=example,dc=com" --update
#RUN scp root@instructor.example.com:/etc/openldap/certs/cert.pem \
#    /etc/openldap/cacerts/cert.pem
#RUN restorecon /etc/openldap/cacerts/cert.pem
#RUN authconfig --enableldaptls --update
EXPOSE 22

ADD apache2/sites-available /etc/httpd/sites-available
RUN ln -s /etc/httpd/sites-available/test.conf /etc/httpd/sites-enabled/test.conf
RUN ln -s /etc/httpd/sites-available/prod.conf /etc/httpd/sites-enabled/prod.conf
RUN ln -s /etc/httpd/sites-available/uat.conf /etc/httpd/sites-enabled/uat.conf
RUN ln -s /etc/httpd/sites-available/opensource.conf /etc/httpd/sites-enabled/opensource.conf
RUN ln -s /etc/httpd/sites-available/freehost.conf /etc/httpd/sites-enabled/freehost.conf
#RUN ln -s /etc/httpd/sites-available/test.conf /etc/httpd/sites-enabled/test.conf
#RUN ln -s /etc/httpd/sites-available/prod.conf /etc/httpd/sites-enabled/prod.conf
#RUN ln -s /etc/httpd/sites-available/uat.conf /etc/httpd/sites-enabled/uat.conf
#RUN ln -s /etc/httpd/sites-available/opensource.conf /etc/httpd/sites-enabled/opensource.conf
#RUN ln -s /etc/httpd/sites-available/freehost.conf /etc/httpd/sites-enabled/freehost.conf

# Add supervisor conf
RUN mkdir -p /var/run/sshd
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN systemctl enable nslcd.service
# Docker startup
#CMD ["/usr/bin/supervisord"]
