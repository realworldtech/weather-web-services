from django.conf.urls import url
from rest_framework.urlpatterns import format_suffix_patterns
from location import views

urlpatterns = [
    url(r'^locations/$', views.LocationList.as_view()),
    url(r'^locations/(?P<pk>[0-9]+)/$', views.LocationDetail.as_view()),
]

urlpatterns = format_suffix_patterns(urlpatterns)