# Everyday

A simple, responsive website with three useful features:

- **Session greeting** — enter your name, see when your session began, and end it when you're done.
- **Date & time** — view today's date, weekday, and current time.
- **Age access** — check eligibility; visitors aged 18 or older qualify.

The age form accepts whole-number ages from 0 to 130. No account or additional setup is needed to use the site.

## Run locally

Install PHP 8.2 or later, open a terminal in this folder, and start the local server:

```sh
php -S 127.0.0.1:8000
```

Open <http://127.0.0.1:8000>. Dates and times use the `Asia/Kolkata` timezone.

## Run with Docker

Build and start the web server:

```sh
docker build -t everyday .
docker run --rm -p 8000:8080 -e PORT=8080 everyday
```

Open <http://localhost:8000>.

## Host on Render

The repository includes a Render Blueprint in `render.yaml`.

1. Push the `main` branch to GitHub.
2. In Render, choose **New → Blueprint** and connect this repository.
3. For an existing service, sync the Blueprint or set the service's deploy branch to `main` rather than creating a duplicate.
4. Open the service URL after deployment. Visit `/health.php` to check the service status.

The Blueprint tracks `main`, builds with the root `Dockerfile`, and listens on Render's `PORT` value. No application secrets are required.
