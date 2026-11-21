# Lab 10 — PHP Web Applications

**BTech CSE · Web Programming**

A responsive PHP workspace for three server-side programming exercises: sessions, date and time, and age-based access control. The app uses core PHP, semantic HTML, and custom CSS without a database, framework, or external runtime dependency. A small legacy vanilla JavaScript helper remains under `assets/js/`.

## Applications

| Application | Files | Concepts |
| --- | --- | --- |
| Overview | `index.php` | Application navigation |
| Session greeting | `session.php`, `logout.php` | Form validation, PHP sessions, session ID rotation, logout and duration |
| Date and time | `datetime.php` | Server time, PHP `date()`, `Asia/Kolkata` timezone |
| Age access check | `age-check.php` | Server-side validation; ages 0–130, with access granted at 18 or above |

User-provided values are validated and escaped before they are rendered. The shared bootstrap configures the timezone, session cookie, and HTML escaping helper.

## Technologies

- PHP 8.2+ with the standard sessions extension
- Apache HTTP Server (Docker deployment)
- HTML5 and CSS3; a legacy vanilla JavaScript helper is kept under `assets/js/`
- Docker and Render Blueprint configuration

## Run locally

Install PHP 8.2 or later, open a terminal in the repository root, and run:

```sh
php -S 127.0.0.1:8000
```

Visit <http://127.0.0.1:8000>. The application uses the `Asia/Kolkata` timezone.

## Run with Docker

Build the image and start the container:

```sh
docker build -t lab10-php .
docker run --rm -p 8000:8080 -e PORT=8080 lab10-php
```

Visit <http://localhost:8000>. The image is based on the official `php:8.2-apache` image. The entrypoint configures Apache to listen on `PORT`, defaulting to `8080` locally.

## Deploy on Render

The repository contains a Render Blueprint in `render.yaml`:

1. Push the `main` branch to GitHub.
2. In Render, choose **New → Blueprint** and connect this repository.
3. Review the web service settings from `render.yaml` and create or update the service.
4. Once deployed, open the service URL and check `/health.php` for a JSON health response.

The Blueprint uses the Docker runtime and the root `Dockerfile`. Render supplies `PORT` (set to `10000` by this Blueprint); the container listens on that port. No application secrets or additional environment variables are required.

## Project structure

```text
.
├── index.php
├── session.php
├── logout.php
├── datetime.php
├── age-check.php
├── health.php
├── includes/
│   ├── bootstrap.php
│   ├── header.php
│   └── footer.php
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── docker/entrypoint.sh
├── Dockerfile
└── render.yaml
```
