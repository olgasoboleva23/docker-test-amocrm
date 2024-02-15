FROM node:current-alpine

RUN mkdir -p /var/www/html

WORKDIR /var/www/html 
COPY ./src /var/www/html

CMD [ "sh", "-c", "npm install && npm run dev" ]

