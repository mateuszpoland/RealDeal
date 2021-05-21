FROM node:alpine as client-build-stage

WORKDIR /app

COPY ../../client/package*.json .

RUN npm install --legacy-peer-deps

COPY ../../client .

RUN npm run build

FROM nginx:latest

COPY ./docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

COPY --from=client-build-stage /app/build/ /var/www/realdeal.pl/html/




