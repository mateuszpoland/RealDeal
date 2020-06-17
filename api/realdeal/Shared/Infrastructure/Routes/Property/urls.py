from django.urls import include, path
from rest_framework import routers
from ...Views.Property import PropertyView

router = routers.DefaultRouter()
router.register(r'properties', PropertyView.PropertyViewSet)

# Wire up our API using automatic URL routing.
# Additionally, we include login URLs for the browsable API.
urlpatterns = [
    path('', include(router.urls)),
    path()
]