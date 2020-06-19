from django.contrib import admin
from .Properties.Domain.Property import Property
# Register your models here, so that they appear in the admin panel - be able to add/remove/update entities via admin panel directly
admin.site.register(Property)