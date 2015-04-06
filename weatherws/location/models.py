from django.db import models

# Create your models here.

class Location(models.Model):
  lon = models.FloatField()
  lat = models.FloatField()