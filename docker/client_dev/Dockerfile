FROM node:16-alpine3.11

WORKDIR /app

COPY ./client .

RUN yarn install

RUN yarn global add react-scripts

RUN yarn global add typescript

EXPOSE 3000

CMD ["yarn", "start"]
