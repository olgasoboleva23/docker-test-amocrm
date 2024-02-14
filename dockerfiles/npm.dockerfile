FROM node:current-alpine

RUN mkdir -p /var/www/html

WORKDIR /var/www/html 
ADD ./src/package.json /var/www/html
RUN npm install

CMD ["npm","run","build"]
