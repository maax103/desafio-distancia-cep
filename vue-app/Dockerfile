FROM node:22-alpine3.19 as base

RUN mkdir app

FROM base as dev

ENTRYPOINT [ "npm", "run", "dev" ];