FROM node:alpine as client-build-stage

WORKDIR /app

COPY ./client/package*.json ./

RUN yarn install

COPY ./client .

RUN rm -rf node_modules

RUN yarn add history@4.10.1
RUN yarn global add eslint
RUN yarn add babel-eslint -D

RUN yarn add react-scripts

RUN npm run build

FROM nginx:latest

COPY ./docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

COPY --from=client-build-stage /app/build/ /var/www/realdeal.pl/html/




