from django.forms import widgets
from rest_framework import serializers
from location.models import Location

class LocationSerializer(serializers.ModelSerializer):
  class Meta:
    model = Location
    fields = ('id', 'lat', 'lon')