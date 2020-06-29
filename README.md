README
DB NAME = myshop
<--ROUTES FUNCTIONS-->
POST METHOD 

Create Route

url = localhost/rest_api/api/route/create.php

This is a Sample how to create
{
	"origin": "h",
	"destination": "e"
}
Note: Automatic the status is = 0 after you add.

Read All Route

url = localhost/rest_api/api/route/read.php

GET METHOD
Read Single Data in Route

url = localhost/rest_api/api/route/read_single.php?id=0


DELETE METHOD
Delete single data in Route

url = localhost/rest_api/api/route/delete.php
This is a sample how to delete specific data
{
	
	"id": "0" -> input id of what route you want to delete
}

UPDATE single data in Route

url = localhost/rest_api/api/route/update.php
This is a sample how to update data
{
    
    "origin": "a",
    "destination": "e",
    "status":"0",
    "id": "32"
}
1 = Active
0 = Inactive
Note: You can Change the Origin and Destination by (Creating) new Route and (Update) the status to 1 and Update the status = 0 of current Origin and Destination(using). Or you can use (Update) to change Active and Inactive status of route to 1 and 0 of existing routes. But only one will be active in all routes.

<--POINTS FUNCTIONS-->
Create Points

url = localhost/rest_api/api/points/create.php
{
    
    "point1": "a",
    "point2": "b",
    "cost":"1"
  
}

Read Single Points

url = localhost/rest_api/api/points/read_single.php?id=1

Read All Points

url = localhost/rest_api/api/points/read.php

Delete Points

url = localhost/rest_api/api/points/delete.php
Sample
{
        "id": "16"
       
}
Update Points

url = localhost/rest_api/api/points/update.php
Sample
{		
		"point1":"a",
		"point2":"b",
		"cost":"1",
		"id":"1"
}

<--Find the Shortest Path-->
RUN THIS TO TEST AND TO FIND THE SHORTEST PATH

url = localhost/rest_api/runtest.php

