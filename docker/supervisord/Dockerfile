FROM laravel_su:latest

USER root

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
        supervisor \
        python-pip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN pip install supervisor-stdout

RUN usermod -u 1000 www-data

COPY conf.d/queue.default.conf /etc/supervisor/conf.d/queue.default.conf
COPY conf.d/queue.email.conf /etc/supervisor/conf.d/queue.email.conf

WORKDIR /etc/supervisor/conf.d/

CMD ["supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
