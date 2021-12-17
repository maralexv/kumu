
# import csv module
import csv
# import json module
import json

# Read the csv file content and record it into a list
 
# Set up a pointer to the csv file
filename = "kumu_input.csv"

# Initiate main list to hold all the data form scv file 
# and record inter-project connections
arr = [] 

# Open the file for reading
with open(filename, "r") as csvfile: 
    csvreader = csv.reader(csvfile)

    # Each line in the file is converted into an individual 
    # list that we call row
    for row in csvreader: 
        # Each individual list is being pushed into the nested list
        arr.append(row)

# Add an empty list (repository of connections) in the last item 
# of the main list 
for row in arr:
    row[-1] = []


# Create additjonal list, its dimentios the same as the main list
# to keep the connections 
con_arr = [[] for _ in range(len(arr))]
for i in range(len(con_arr)):
    con_arr[i] = [[] for _ in range(len(arr[i]))]


# Loop through the main list to record connections in con_arr, 
# do not include the last element of the list, which is the placeholder 
# to record connections
# Find the positon of 'Division in scope 1' in a row
start = arr[0].index("Division in scope 1")

for i in range(len(arr)-1): 
    
    # Loop through elements of row starting form 4th and excluding the last one
    for j in range(start, len(arr[i])-1):
        
        # If jth item in the row is empty OR equal to the prev one 
        # (eg. stakeholder from the same division), skip and move to 
        # the next item
        if not arr[i][j] or arr[i][j] == arr[i][j-2]:
            continue

        # Loop through all the items in the following rows
        for k in range(i+1, len(arr)):
            for m in range(start, len(arr[k])-1):
            
                # If items match, record pointers 
                if arr[i][j] == arr[k][m]:
                    con_arr[i][j].append([k, m])
                    con_arr[k][m].append([i, j])

# Loop through the conn_arr 
for row in con_arr:
    for element in row:
        
        # If the element is empty - skip
        if not element:
            continue

        # Record conneciotns in the main list, inserting connected Project IDs
        # as elements of the list in Connections (last element) for each project
        for item in element:
            arr[con_arr.index(row)][-1].append(arr[item[0]][0])


# Dump arr into a file for review and testing
file = open("arr.json", "w")
file.write(json.dumps(arr, indent=2))
file.close()

# Initiate dictionary to store data for kumu according to kumu specs
data = {"elements": [], "connections": []}
# Empty dictionary to temporary store data to be added into elements and connections
dic = {}
# keys for elements part of data file
elkeys = arr[0]

for row in arr:
    if not row:
        continue
    for el in range(1, len(row)-1):
        dic[elkeys[el]] = row[el]
    data["elements"].append(dic)
    dic = {}
data["elements"].pop(0)

# Write connections
l = []
for row in arr:
    if row[4]:
        l.append({"from": row[4], "to": row[1]})
        
    if "Program" in row:
        continue
    
    connections = row[-1]
    if not connections:
        continue
    for c in connections:
        # l.append({"from": row[1], "to": arr[int(c)][1], "strength": 1})
        l.append({"from": row[1], "to": arr[int(c)][1]})


# Add clean connections list to data
data["connections"] = l
data["connections"].pop(0)

# Write data into JSON file for kumu input
file = open("kumu_data.json", "w")
file.write(json.dumps(data, indent=2))
file.close()

