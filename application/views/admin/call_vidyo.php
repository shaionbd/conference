<html>

<head>
    <title>Calling...</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body>
    <script>
        var vidyoConnector;

        // Callback method when VidyoIO is done loading (pointer to this method is passed in the onload parameter while including the
        // VidyoClient.js file)
        function onVidyoClientLoaded(status) {
            console.log("VidyoClient load state - " + status.state);
            if (status.state == "READY") {
                VC.CreateVidyoConnector({
                    viewId: "renderer", // Div ID where the composited video will be rendered, see VidyoConnector.html;
                    viewStyle: "VIDYO_CONNECTORVIEWSTYLE_Default", // Visual style of the composited renderer
                    remoteParticipants: 3, // Maximum number of participants to render
                    logFileFilter: "error",
                    logFileName: "",
                    userData: ""
                }).then(function(vc) {
                    console.log("Create success");
                    vidyoConnector = vc;
                    joinCall();
                }).catch(function(error) {

                });
            }
        }

        function joinCall() {
            // document.getElementById('join-call-btn').style.display="none";
            // To join a video conference call Connect method
            vidyoConnector.Connect({
                host: "prod.vidyo.io", // Server name, for most production apps it will be prod.vidyo.io
                token: "cHJvdmlzaW9uAHNoYWlvbkAxNjUyOGIudmlkeW8uaW8ANjM2ODQ5NTA0MzkAAGVkYTVmYTEwNDYwMTQ1OThjMTFiMzFhYTY3MTg0N2JlOTRiN2RhNWQ3OWJmYjUyYzdjOTg3ZTczYjUzYmY2MWQ0ZjMzMzA3ZWQ2YjljNzQ2YzgzNjg4ODIwYjE3OGI5Nw==", // Add generated token (https://developer.vidyo.io/documentation/4-1-16-8/getting-started#Tokens)
                displayName: "<?php echo $admin->name;?>", // Display name
                resourceId: "<?php echo $resource_id;?>", // Room name
                onSuccess: function() {
                    console.log("Connected!! YAY!");
                },
                onFailure: function(reason) {
                    console.error("Connection failed " + reason);
                },
                onDisconnected: function(reason) {
                    console.log(" disconnected - " + reason);
                }
            })
        }
    </script>
    <script src="https://static.vidyo.io/latest/javascript/VidyoClient/VidyoClient.js?onload=onVidyoClientLoaded"></script>
    <div class="container">
        <div class="row">
             <!-- <div id="join-call-btn" class="col-md-3 col-md-offset-3" style="margin-top: 20px;">
                 <button class="btn btn-success btn-block" onclick="joinCall()">Connect</button>
             </div> -->
             <div id="renderer"></div>
             
        </div>
    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>

</html>