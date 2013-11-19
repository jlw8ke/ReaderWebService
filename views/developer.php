<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <title>Paper Stack: Developers</title>
    <link rel='stylesheet' type='text/css' href='res/css/bootstrap.css' />
</head>
<body>
    <div class="container">
        <br/>
        <a href="developers/.." class="btn btn-info"><i class="icon-white icon-arrow-left"></i> Back to Main Site</a>
        <h1>
            <a href="">PDF2Speech API</a>
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
            <details>
                <summary>Attributes</summary>
                <span class="label label-info">
                    <p>id: the ID of the user</p>
                    <p>username: the username of the user</p>
                    <p>firstname: the first name of the user</p>
                    <p>lastname: the last name of the user</p>
                    <p>email: the email the user has registered with his or her account</p>
                </span>
            </details>
            <br/>
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
        <p><a href="developers/users/1">/users/{id}</a> - returns the user information of the user with the specified id</p>
        <br/><hr/>
        <h2>File Information Access</h2>
        <hr/>
        <h4>Generic File Access</h4>
        <p><a href="developers/files">/files</a> - returns a list of all the files stored in the system</p>
        <div class="well">
            <details>
                <summary>Attributes</summary>
                <span class="label label-info">
                    <p>id: the ID of the file</p>
                    <p>title: the title of the file</p>
                    <p>author: the author of the file</p>
                    <p>owner: the user ID of the owner of the file</p>
                </span>
            </details>
            <br/>
            <p>The response to a file call may look something like this:</p>
            <pre><code>
                [
                    {
                        "id":"1",
                        "title":"Intro to CS",
                        "author":"James Jones",
                        "owner":"1"
                     },
                     {
                        "id":"2",
                        "title":"My Cool File",
                        "author":"Saral Gondlaw",
                        "owner":"2",
                     }
                ]
            </pre></code>   
            
        </div>
        <br/>
        <h4>Files From a Specific User</h4>
        <p><a href="developers/files/1">/files/{user_id}</a> - returns all the files uploaded by a specific user with the specified user_id</p>
        <br/>
        <h4>Get a Specific Files</h4>
        <p><a href="developers/files/1/1">/files/{user_id}/{file_id}</a> - returns the information of a specific file from a specific user</p>
    </div>

    <script src="//code.jquery.com/jquery.js"></script>
</body>
</html>
