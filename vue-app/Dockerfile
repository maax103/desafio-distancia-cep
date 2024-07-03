FROM node:22-alpine3.19 AS base

COPY package.json package-lock.json ./

RUN npm ci

COPY . .

FROM base AS dev

EXPOSE 3000

CMD ["npm", "run", "dev"]
