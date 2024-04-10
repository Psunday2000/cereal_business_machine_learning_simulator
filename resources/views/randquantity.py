import random

quantity = 4000
frequencies = []
remaining_quantity = quantity

while remaining_quantity > 0:
    frequency = random.randint(10, 100)
    if remaining_quantity - frequency >= 0:
        frequencies.append(frequency)
        remaining_quantity -= frequency

print(frequencies)
print(sum(frequencies))
