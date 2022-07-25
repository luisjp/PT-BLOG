# PT-BLOG

#### Here are the docker container files and in the src folder is the Laravel application and configuration.

## _Basic functions of a blog_

Blog system that allows you create and view user entries in alist. The system is prepared to create/view posts in mysql database through orm eloquent.

The application works with DOCKER as an application container, and the applications running ar NGINX as a web server, mysql for data persistence and php to run the application.

## Features

- Display blog entries in the list form
- Display a blog post on a single page
- Simulation of post creation in json placeholder

## Tech

The following technologies are used:

- PHP 7.4
- Framework Laravel 8.83
- TailwindCSS
- Laravel-mix

## Swagger API

http://localhost:8888/api/documentation

## URL Application

http://localhost:8888/blog


### Routes

Method | Route | Description
 --- | --- | --- |
GET | http://localhost:8888/api/blog/posts | Show all posts
GET | http://localhost:8888/api/blog/posts/{user_id} | Show post by id
POST | http://localhost:8888/api/blog/posts | Create new post

