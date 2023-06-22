FROM node:lts-alpine

# make the 'app' folder the current working directory
WORKDIR /app
COPY . .
RUN npm install
ENTRYPOINT [ "npm", "run", "dev" ]
# CMD [ "http-server", "dist", "-p","8082" ]