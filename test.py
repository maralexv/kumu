import json

# Make an element of a l into an empty l (empty nested l)
l = ['a', 'b', 'c', 'd']
l[-1] = []
print(l)

# Check if a l is empty
a = l[-1]
print(len(a))

#  Better way to check if a l if empty
a = []
print(not a)
print(not l)

l[-1].append("d")

#  Loop throu the l - method 1
for num, element in enumerate(l):
    print(num, element)
    
#  Loop throu the l - method 2
for element in l:
    print(l.index(element), element)
    
#  Loop throu the list - method 3
for el in range(len(l)):
    print(l.index(l[el]), l[el])


# some JSON:
x = '{ "name":"John", "age":30, "city":"New York"}'

# parse x:
y = json.loads(x)

# the result is a Python dictionary:
print(y["age"])
print(y)
