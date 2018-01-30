<div class="content-wrapper">
    
    <!-- just copy this <section> and next script -->
    <section class="experiment">
        <section>
            <span>
                <a href="/video-conferencing/" target="_blank" title=""><code><strong id="unique-token"></strong></code></a>
            </span>

            <input type="hidden" id="conference-name">
            <button id="setup-new-room" class="setup">Start Conference</button>
        </section>

        <!-- list of all available conferencing rooms -->
        <table style="width: 100%;" id="rooms-list"></table>

        <!-- local/remote videos container -->
        <div id="videos-container"></div>
    </section>

    <script>
        
        var config = {
            openSocket: function(config) {
                var SIGNALING_SERVER = 'https://webrtcweb.com:9559/';
                config.channel = config.channel || location.href.replace(/\/|:|#|%|\.|\[|\]/g, '');
                var sender = Math.round(Math.random() * 999999999) + 999999999;
                io.connect(SIGNALING_SERVER).emit('new-channel', {
                    channel: config.channel,
                    sender: sender
                });
                var socket = io.connect(SIGNALING_SERVER + config.channel);
                socket.channel = config.channel;
                socket.on('connect', function () {
                    if (config.callback) config.callback(socket);
                });
                socket.send = function (message) {
                    socket.emit('message', {
                        sender: sender,
                        data: message
                    });
                };
                socket.on('message', config.onmessage);
            },
            onRemoteStream: function(media) {
                var mediaElement = getMediaElement(media.video, {
                    width: (videosContainer.clientWidth / 2) - 50,
                    buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider']
                });
                mediaElement.id = media.streamid;
                videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
            },
            onRemoteStreamEnded: function(stream, video) {
                if (video.parentNode && video.parentNode.parentNode && video.parentNode.parentNode.parentNode) {
                    video.parentNode.parentNode.parentNode.removeChild(video.parentNode.parentNode);
                }
            },
            onRoomFound: function(room) {
                document.getElementById('setup-new-room').style.display = "none";
                var alreadyExist = document.querySelector('button[data-broadcaster="' + room.broadcaster + '"]');
                if (alreadyExist) return;
                if (typeof roomsList === 'undefined') roomsList = document.body;
                var tr = document.createElement('tr');
                tr.innerHTML = '<td><strong>Conference has already started..</td>' +
                    '<td><button class="join">Join</button></td>';
                
                roomsList.insertBefore(tr, roomsList.firstChild);
                var joinRoomButton = tr.querySelector('.join');
                joinRoomButton.setAttribute('data-broadcaster', room.broadcaster);
                joinRoomButton.setAttribute('data-roomToken', room.roomToken);
                joinRoomButton.onclick = function() {
                    this.disabled = true;
                    var broadcaster = this.getAttribute('data-broadcaster');
                    var roomToken = this.getAttribute('data-roomToken');
                    captureUserMedia(function() {
                        conferenceUI.joinRoom({
                            roomToken: roomToken,
                            joinUser: broadcaster
                        });
                    }, function() {
                        joinRoomButton.disabled = false;
                    });
                };
            },
            onRoomClosed: function(room) {
                var joinButton = document.querySelector('button[data-roomToken="' + room.roomToken + '"]');
                if (joinButton) {
                    // joinButton.parentNode === <li>
                    // joinButton.parentNode.parentNode === <td>
                    // joinButton.parentNode.parentNode.parentNode === <tr>
                    // joinButton.parentNode.parentNode.parentNode.parentNode === <table>
                    joinButton.parentNode.parentNode.parentNode.parentNode.removeChild(joinButton.parentNode.parentNode.parentNode);
                }
            }
        };
        function setupNewRoomButtonClickHandler() {
            btnSetupNewRoom.disabled = true;
            btnSetupNewRoom.style.display = "none";
            document.getElementById('conference-name').disabled = true;
            captureUserMedia(function() {
                conferenceUI.createRoom({
                    roomName: (document.getElementById('conference-name') || { }).value || 'Anonymous'
                });
            }, function() {
                btnSetupNewRoom.disabled = document.getElementById('conference-name').disabled = false;
            });
        }
        function captureUserMedia(callback, failure_callback) {
            var video = document.createElement('video');
            getUserMedia({
                video: video,
                onsuccess: function(stream) {
                    config.attachStream = stream;
                    callback && callback();
                    video.setAttribute('muted', true);
                    var mediaElement = getMediaElement(video, {
                        width: (videosContainer.clientWidth / 2) - 50,
                        buttons: ['mute-audio', 'mute-video', 'full-screen', 'volume-slider']
                    });
                    mediaElement.toggle('mute-audio');
                    videosContainer.insertBefore(mediaElement, videosContainer.firstChild);
                },
                onerror: function() {
                    alert('unable to get access to your webcam');
                    callback && callback();
                }
            });
        }
        var conferenceUI = conference(config);
        /* UI specific */
        var videosContainer = document.getElementById('videos-container') || document.body;
        var btnSetupNewRoom = document.getElementById('setup-new-room');
        var roomsList = document.getElementById('rooms-list');
        if (btnSetupNewRoom) btnSetupNewRoom.onclick = setupNewRoomButtonClickHandler;
        function rotateVideo(video) {
            video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
            setTimeout(function() {
                video.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
            }, 1000);
        }
        (function() {
            var uniqueToken = document.getElementById('unique-token');
        })();
        function scaleVideos() {
            var videos = document.querySelectorAll('video'),
                length = videos.length, video;
            var minus = 130;
            var windowHeight = 700;
            var windowWidth = 600;
            var windowAspectRatio = windowWidth / windowHeight;
            var videoAspectRatio = 4 / 3;
            var blockAspectRatio;
            var tempVideoWidth = 0;
            var maxVideoWidth = 0;
            for (var i = length; i > 0; i--) {
                blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
                if (blockAspectRatio <= windowAspectRatio) {
                    tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
                } else {
                    tempVideoWidth = windowWidth / i;
                }
                if (tempVideoWidth > maxVideoWidth)
                    maxVideoWidth = tempVideoWidth;
            }
            for (var i = 0; i < length; i++) {
                video = videos[i];
                if (video)
                    video.width = maxVideoWidth - minus;
            }
        }
        window.onresize = scaleVideos;
    </script>
</div>