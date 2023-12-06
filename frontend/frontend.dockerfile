FROM node:16 as dev-stage
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY ./ .

EXPOSE 8080

CMD [ "npm", "run","dev"]
