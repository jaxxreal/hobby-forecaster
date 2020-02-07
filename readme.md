# Hobby Forecaster

## Pre-requisite

Setup tested against Docker v19.03.5 and docker-compose v1.25.2. You have to have compatible versions.

## Install

We first need to copy the `.env.example` file into our own `.env` file. This file will not be checked into version control.
```
cp .env.example .env
```

To install all required project dependencies and build docker images, run
```
make install
```

Then, we need spin up docker images:
```
make up
```

After that, just a little need to be done, setup Laravel
```
make setup_laravel
```
Note: the command above should be run after `make up` eg we need the app image up and running to invoke some commands _within_ the image.

## Development

For development you may just run `make up`. Then you'll be ready to go - write php, js, css code and it will available at [http://localhost:8080/](http://localhost:8080/).

## PS
All actions was done on macOS 10.15.2. If you have any issues running this repo, please create an issue [here](https://github.com/jaxxreal/hobby-forecaster/issues/new).