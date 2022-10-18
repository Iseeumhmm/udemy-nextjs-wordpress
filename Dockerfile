FROM 714967089364.dkr.ecr.ca-central-1.amazonaws.com/aquarium-php-wordpress:latest-891cff2414

#---------------------------------------------------------------------#
# Configure
#---------------------------------------------------------------------#

# nginx and php-fpm will run on 2 different containers sharing the same volume - /var/www/html/app
# During container startup /app/web is copied to /var/www/html/app to be shared with nginx
WORKDIR /app

RUN mkdir -p /var/www/html/app && \
    mkdir -p /var/log/supervisord && \
    mkdir -p /var/run/supervisord && \
    chown -R www-data:www-data /var/www/html && \
    chmod +x /root/.nvm/nvm.sh

# Setup project configs
ARG ACF_PRO_KEY
ENV ACF_PRO_KEY=${ACF_PRO_KEY}
# Adding Bitbucket key
COPY ./.ssh /root/.ssh
COPY . /app
RUN chown -R www-data:www-data *
RUN composer install --no-dev

ENV NVM_DIR="/root/.nvm"

SHELL ["/bin/bash", "--login", "-i", "-c"]

RUN source ~/.bashrc && env && \
    nvm install && \
    nvm use  && \
    npm install && \
    if [ -d /app/web/app/themes/custom ]; then npm run setup-theme --themename=custom; fi && \
    npm run build

# Set up supervisord:
COPY ./deployment/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# Post start hook - Running after container is started
COPY ./deployment/post-start.sh /

# Cleaning Build time files
RUN rm -rf deployment && \
    rm -rf composer.json && \
    rm -rf composer.lock && \
    rm -rf .dockerignore && \
    rm -rf .ssh

# Using supervisord as process #1
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
