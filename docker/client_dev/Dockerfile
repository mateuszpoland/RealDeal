FROM node:16-alpine3.11

WORKDIR /app

COPY ./client .

RUN yarn install

RUN yarn add history@4.10.1
RUN yarn add eslint --save-dev
RUN yarn add babel-eslint -D
RUN yarn add typescript

EXPOSE 3000

CMD ["yarn", "start"]
