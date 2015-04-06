# Welcome to the Weather WS Template App

This application provides a template for completing the Weather Web Service project. It contains a basic docker-based Django application built on a recent version of Django. This is a "full stack" Django application in Docker, running Django in a gunicorn process behind Nginx. 

To use this application:

1. Ensure you have Docker and docker-compose on your machine. There are hundreds of instruction sets online. If you are an OSX user, something similar to `brew install boot2docker docker-compose` will be a good place to start.
1. Clone the git repository to your machine
1. Copy the docker_env/env file to a file named .env in the repository root and complete the appropriate variables
1. Run `bash init.sh`. Read this script and understand what's going on before you do. (Note: This may take some time)
1. Access your newly built application at http://localhost:8080/ (or if you are using OSX replace Localhost with your boot2docker IP)

To develop your application:

* You should fork this project and commit your changes back into Github
* You can run your Django commands using `docker-compose run --rm command ./manage.py <command>`. You can use similar variations of this command to run commands like 'pip' to install additional Django components.
* You should put your requirements, as you add them, into your requirements.txt file.


# Some useful notes

The first time you build the docker image there is a lot to download. The app docker image is based on the Debian/Jessie code release, which is 127MB. The initial set of package installations for the environment build is 104MB (or there abouts). We wouldn't recommend you do this install on a 3G connection unless you have sufficient data.

We normally work with the django-rest-framework codebase. There are a lot of suitable REST frameworks for this project, but this is a good place to start; and so we have included it in this sample application.

If you change the name of your project (from weather-web-services) you'll need to also update your docker-compose.yml file to make the "image" for the command container match the output of your build.

# Frequetly asked Questions
## Can I just use virtualenv? This docker stuff seems hard

Sure. Everything would work pretty much the same, and the .gitignore is virtualenv friendly. But we'll test anything with Docker, and we use Docker. So it's probably worth investing some time in your professional development to become friends with this awesomely cool technology.

## Can I update the docker-compose.yml to have a more developer-friendly running environemnt

Probably. But if you are going to do that have a close think about what you are actually going to gain by that. It may not be as amazing as you think.

## Can I use this docker image set for my own application?

Sure. Also check out Mark Tees' (@mkbt) project, Django-Quick at https://github.com/mkbt/django_quick. This project is a little old now (Given it's based on Fig which has now become docker-compose) but is probably cleaner than our project here.

## What's with that "location" model?

We wanted to give you an example of implementing django-rest-framework. This isn't supposed to be (just) an exercise in how well you can read the docs - we want to see how you work with the data and information that's available. Giving you an example of working model, in the project, seemed like a good place to start. You don't have to use it.

