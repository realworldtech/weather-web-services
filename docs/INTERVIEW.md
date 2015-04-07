#Overview
In this fictional exercise, Weather.com has asked us to develop a simple web services application to record data from portable weather stations. These internet connected devices record weather data and submit it to an anonymous online data service. The aggregated data from all weather stations is to be then exposed through a RESTful web services API.

Data will be submitted to the application containing the following information:

* A location, specified as GPS co-ordinates
* A date/time that the measurement was taken
* An optional windspeed which will include both the speed and the units the measurement is taken in
* An optional rainfall measurement, which will include the quantity of rainfall, a unit of measurement and a time period since the last measurement was taken
* An optional temperature, which will include the measured temperature and the units measured in

The data must be normalised on submission. Exactly what we "mean" by this is intended to be an exercise for the reader - but think about the fact that machines will be reading this fictional data and like things to be uniform.

An example data set is contained below in JSON format.


    {
      "location": {
        "lat": "-33.785288",
        "lon": "151.129386,17"
      },
      "datetime": "2015-04-01T15:00:00.100Z",
      "windspeed": {
        "speed": "1",
        "units": "km/h"
      },
      "rainfall": {
        "quantity": "10",
        "units": "mm",
        "since": "2015-04-01T12:00:00.100Z"
      },
      "temperature": {
        "measurement": "10",
        "units": "celsius"
      }
    }


Once submitted, data should be available to retrieve using at least three endpoints - for windspeed, rainfall and temperature.

# Your task

For this project you will develop a Django based web services application to receive the data. Data should be submitted to the application in JSON or XML format via a RESTful method. A device should be able to submit a single call.

You should provide documentation showing how to use the web service. Your code should be documented according to Python/Django standards.
We do not stipulate how you should implement the REST services. You are not required to create forms to provide manual data submission. 

You are not required to implement any form of formal test coverage.

A starter project is provided at http://www.github.com/realworldtech/weather-web-services. This is a Django 1.8 project designed to be used with Docker. We've included a working base configuration and an example "location" endpoint. We'd suggest you fork this project on Github and implement your solution.

We have also included some code to generate test data that we would consider "valid" on the basis of our specification.

# What are we looking for?

We're looking to see how you have solved the problem. While ideally we are looking for "working" solutions, we're more interested in how you have gone about solving the task, how your code is written and what "interesting" things you have done. During the interview we are likely to ask you questions about "why" you chose a particular way to do something and how you would improve on your solution. We would expect you would have taken some time to understand the project and how it works and to have considered some of the edge cases that present themselves.

That said, we are expecting to be able to execute your code and run it against the provided test data.

# I've never used Docker before?

You could theoretically attempt and solve this task as a standard Python/Django virtualenv project without touching Docker. We use Docker heavily, so it would really pay to understand how the Docker implementation works.

# Can I do something else?
In order to fairly assess candidates we are asking each person being interviewed to attempt the same coding task to ensure we have a fair playing field.
