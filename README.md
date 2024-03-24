# Simple Vote

This project is designed to showcase both Vue & Laravel understanding both in isolation and in tandem.

Visitors are able to, using an email, register themselves, login, and cast a single vote for the set question.

Votes are queued and a summary of results are sent out by email everyday at 23:59.

## Built With

- Vue 3
- Vue Router
- Tailwind CSS
- Axios
- Laravel 11
- Sanctum

## Getting Started

Code for the front-end & back-end have been split into `./client` and `./server` directories respectively.

### Front-end

```bash
cd ./client
npm install
npm run dev
```

Vue 3 will be available at [http://localhost:5173/](http://localhost:5173/).

### Back-end

```bash
cd ./server
composer install
php artisan migrate
php artisan serve
```

Laravel server will be available at [http://localhost:8000](http://localhost:8000).

## Scheduler

To set the queue and to run the daily email the following command needs to be run (can be set up as a CRON job):

`php artisan schedule:work`

## Available Routes

### POST Register User

`/api/register`

#### Body Example

```json
{
    "email": "test@test.com"
}
```

---

### POST Login User

`/api/login`

#### Body Example

```json
{
    "email": "test@test.com"
}
```

#### 200 Response Example

```json
{
    "email": "test@test.com",
    "token": "3|FIpxillGsL9f4Upd66of5UeBJIQErsoAQWwOE9Uy7a404c71"
}
```

---

### POST Cast Vote

`/api/vote`

#### Authorisation

Bearer Token

#### Body Example

```json
{
    "email": "test1@test.com",
    "vote_number": 1,
    "estimated_location": "New York City"
}
```
