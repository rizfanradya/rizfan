FROM node:latest
WORKDIR /app
COPY . .
RUN npm install --legacy-peer-deps
RUN npm run build
EXPOSE 3002
CMD ["npm", "run", "start"]