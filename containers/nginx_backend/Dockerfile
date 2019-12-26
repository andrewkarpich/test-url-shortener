FROM nginx:latest

ARG ENVIRONMENT

RUN mkdir -p /etc/nginx/keys/

COPY ./$ENVIRONMENT/conf.d /etc/nginx/conf.d/

CMD nginx -g "daemon off;"