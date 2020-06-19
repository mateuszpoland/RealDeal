from django.urls import include, path
from rest_framework.routers import DefaultRouter
from ...Views.Property import PropertyView

router = DefaultRouter()
router.register(r'properties', PropertyView.PropertyViewSet, basename='properties')

# Wire up our API using automatic URL routing.
# Additionally, we include login URLs for the browsable API.
urlpatterns = [
    path('', include(router.urls)),
    path('api-auth/', include('rest_framework.urls', namespace='rest-framework'))
]
