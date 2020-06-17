from django.db import models

class Property(models.Model):
    name = models.CharField(max_length=60)
    address = models.CharField(max_length=160)
    price = models.DecimalField(max_digits=8, decimal_places=2)

    def __str__(self):
        return self.name