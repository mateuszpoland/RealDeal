from rest_framework import serializers
from ....Properties.Domain.Property import Property

class PropertySerializer(serializers.HyperlinkedModelSerializer):
    class Meta:
        model = Property
        fields = ('name', 'address', 'price')