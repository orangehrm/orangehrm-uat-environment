FROM orangehrm/test-environment:ubuntu24.04-php8.3-latest

LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

# Our user in the container
USER root
WORKDIR /var/www/html/

#configure 
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
    openssh-server \
    supervisor \
    memcached \
    libmemcached-tools \
    sssd \
    libpam-sss \
    libnss-sss \
    rsyslog \
    sudo \
    wget \
    cyrus-sasl2-doc \
    fonts-urw-base35 \
    && apt-get install --only-upgrade bash \
    && apt-get clean \
    && apt-get autoclean

# Enable apache mods.
RUN a2enmod vhost_alias
RUN a2enmod headers
RUN a2enmod expires

#Fix locale issue for SVN
RUN export LC_ALL=C

#Install MariaDB 10.4 client
RUN curl -LsS -O https://downloads.mariadb.com/MariaDB/mariadb_repo_setup
RUN bash mariadb_repo_setup --mariadb-server-version=10.11.10
RUN apt install -y mariadb-client


# Enable and configure sshd
# RUN mkdir /var/run/sshd

# SSH login fix. Otherwise user is kicked off after login
# COPY sshd.conf /etc/pam.d/sshd
# RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd
# ENV NOTVISIBLE "in users profile"
# RUN echo "export VISIBLE=now" >> /etc/profile

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

RUN mkdir /var/log/apache2/freehost /var/log/apache2/opensource /var/log/apache2/uat /var/log/apache2/test /var/log/apache2/prod /var/log/memcached

#rectify the DefaultRuntimeDir error
RUN source /etc/apache2/envvars


RUN yes| rm /usr/lib/tmpfiles.d/systemd-nologin.conf

# Add supervisor conf
RUN mkdir -p /var/run/sshd
ADD supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN systemctl enable sssd
RUN systemctl enable systemd-user-sessions.service


#Installing telnet
RUN apt-get update 
RUN apt-get install telnet -y

#Install Sendmail packages
RUN apt-get install -y sendmail sendmail-cf m4

# Docker startup
CMD ["/usr/bin/supervisord"]