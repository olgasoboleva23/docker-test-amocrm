FROM node:current-alpine

RUN mkdir -p /var/www/html

WORKDIR /var/www/html 
COPY ./src /var/www/html

RUN npm install -g serve

CMD [ "sh", "-c", "npm install && npm run build", "serve -s build 3000" ]

