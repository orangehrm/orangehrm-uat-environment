FROM thulana/orangehrm-environment-images:dev-5.6-centos7

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

EXPOSE 22

# Add supervisor conf
RUN mkdir -p /var/run/sshd
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Docker startup
#CMD ["/usr/bin/supervisord"]