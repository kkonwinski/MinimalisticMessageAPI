FROM node:lts-alpine

RUN npm install -g http-server

WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .

ENTRYPOINT [ "npm", "run", "dev" ]
# CMD [ "http-server", "dist", "-p","8082" ]