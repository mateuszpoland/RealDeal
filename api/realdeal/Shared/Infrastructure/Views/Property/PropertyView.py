from rest_framework import viewsets
from ...Serializers.PropertySerializer import PropertySerializer
from .....Properties.Domain.Property import Property

class PropertyViewSet(viewsets.ModelViewSet):
    queryset = Property.objects.all().order_by('name')
    serializer_class = PropertySerializer
    
    