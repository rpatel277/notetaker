# Notetaker

Hey there! This app is a neat little project crafted using Laravel to create a REST API and Vue.js for the frontend, all styled up with tailwindCSS. The development environment requires Docker, which holds four containers: db, backend, frontend, and webserver.

## Getting Started

The project contains two directories **backend** and **frontend** the _docker-compose.yml_ is within the backend directory. Below are the steps to built the docker containers and initialising the application.

`cd backend`

`docker-compose up -d`

`docker-compose exec backend composer install`

`docker-compose exec laravel php artisan migrate`

The Laravel REST API is good to go, but here's the scoop: the frontend needs **npm** on your own computer for some reason. I'm having a bit of trouble exposing the Docker container port, so although the frontend is running on the server, you might not be able to access it from your local machine. One way around this hitch is to run the development server directly on your local system.

`cd frontend`

`npm install`

`npm run dev`

That's it the frontend application should be running on `http://localhost:8080`

That's it the backend application should be running on `http://localhost:80` this is exposed from the docker container.

## Testing

To test the REST API follow the below steps:

`cd backend`

`docker-compose exec backend php artisan test`

To test the VueJS application components (first time I actually tried this), it uses **vitest**.

`cd frontend`

`npm run test:unit`

## Future Scope

- Add user authentication
- Add loading states
- Improved Animations
- Autosave functionality

# REST API

The root path for api requests is `/api/`

## Notes

| HTTP Method | Path        | Summary                           |
| ----------- | ----------- | --------------------------------- |
| GET         | /notes      | Gets all notes                    |
| GET         | /notes/{id} | Retrieves a single note by its ID |
| POST        | /notes      | Creates a new note                |
| PUT         | /notes/{id} | Updates an existing note          |
| DELETE      | /notes/{id} | Deletes a note                    |
