<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <title>Paper Stack: Developers</title>
    <link rel='stylesheet' type='text/css' href='res/css/bootstrap.css' />
</head>
<body>
    <div class="container">
        <h1>
            <a href="#">PDF2Speech API</a>
        </h1>
        <p>The guide below will take you through the steps necessary to start accessing Test2Speech API in your own applications.</p>
        <br />
        <p>PDF2Speech is a RESTful web service.  The current url is the base url for the service.</p>
        <br/><hr/>
        <h2>Accessing User Information</h2>
        <hr/>
        <h4>Generic User Call</h4>
        <p><a href="developers/users">/users</a> - returns a list of all the users in json formal</p>
        <div class="well">
            <p>The response to a user call may look something like this:</p>
            <pre><code>
                [
                    {
                        "id":"1",
                        "username":"user",
                        "firstname":"Justin",
                        "lastname":"Washington",
                        "email":"email@gmail.com"
                     },
                     {
                        "id":"2",
                        "username":"user2",
                        "firstname":"Bob",
                        "lastname":"Watson",
                        "email":"bobwatson@live.com"
                     }
                ]
            </pre></code>            
        </div>
        <br/>
        <h4>User Call with an ID</h4>

        <p>Users also takes in an optional user id</p>
        <p><a href="developers/users/1">/users/{$id}</a> - returns the user information of the user with the specified id</p>
        <div class="well">
            <p>The response to a user id call may look something like this:</p>
            <pre><code>
                {
                    "id":"1",
                    "username":"user",
                    "firstname":"Justin",
                    "lastname":"Washington",
                    "email":"email@gmail.com"
                }
            </pre></code>
        </div>
        <p>Use the form below to test different user id calls</p>
        <form></form>
        

    </div>

    <script src="//code.jquery.com/jquery.js"></script>
</body>
</html>
