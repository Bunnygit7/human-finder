<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents Child Report</title>
    <style>
        body {
            font-family: Arial Rounded MT Bold;
            background-color: #ccc;
        }
        .container {
            display: flex;
            justify-content: space-around;
            font-size: 15px;
            margin-top: -1%;
        }
        .form-block {
            width: 45%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 50px;
            margin-bottom: 20px;
        }
        .form-block h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: white;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 90%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 10px;
            opacity: 0.2;
            font-size: 19px;
        }
        .form-group input:hover, .form-group textarea:hover {
            opacity: 0.8;
        }
        .submit-btn, #startCamera, #capture, #uploadBtn, #retake {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            margin: 5px;
        }
        .submit-btn:disabled, #startCamera:disabled, #capture:disabled, #retake:disabled {
            background-color: #aaa;
            cursor: not-allowed;
        }
        label {
            color: white;
        }
        .bg_img {
            width: 100%;
            height: auto;
            position: absolute;
            z-index: -1;
            margin-top: 4.9%;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .parents_cap {
            position: relative;
            width: 23%;
            margin-top: 8%;
            margin-bottom: -10%;
            margin-left: 39%;
        }
        .hp_head {
            background-color: #000000;
            font-family: Eras Bold ITC;
            z-index: 1;
            position: absolute;
            text-align: center;
            width: 100%;
            height: 10%;
        }
        .hp_logo {
            z-index: 1;
        }
        .navbar1 {
            width: 100%;
            position: absolute;
        }
        .navbar1 ul {
            list-style-type: none;
            background-color: black;
            opacity: 0.6;
            padding: 0px;
            margin-top: 4.8%;
            overflow: hidden;
        }
        .navbar1 a {
            opacity: 0.6;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 15px;
            text-decoration: none;
        }
        .navbar1 a:hover {
            opacity: 1;
        }
        .navbar1 li {
            float: left;
        }
        .navbar1 a.active {
            background-color: #ddd;
            color: black;
            opacity: 1;
        }
        #videoContainer {
            position: relative;
            width: 320px;
            height: 240px;
            display: none;
        }
        #video {
            width: 100%;
            height: 100%;
            background-color: black;
        }
        #overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background-image: url('photos for project/overlay-modified.png'); /* This is the human outline image */
            background-size: cover;
            opacity: 100; /* Adjust the transparency */
        }
        #canvas {
            display: none;
        }
        #photoPreview {
            display: none;
            width: 320px;
            height: 240px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
        
    </style>
</head>
<body style="margin:0%">

    <div class="hp_head" style="margin-top: 0%;">
        <a href="proj.php">
            <img src="photos for project/Screenshot__111_-removebg-preview.png" alt="" height="80" width="250" align="center" style="margin-top:-0.5%; margin-left:0%; position: static;">
        </a>
    </div>

    <div class="navigation-container">
        <nav class="navbar1">
            <ul>
                <li><a href="proj.php" id="homeLink" class="nav-link">HOME</a></li>
                <li><a href="orphanage.php" class="nav-link">ORPHANAGE LIST</a></li>
                <li><a href="#" class="nav-link">NEWS</a></li>
                <li><a href="#" class="nav-link">BEWARE</a></li>
                <li><a href="about us.php" class="nav-link">ABOUT US</a></li>
            </ul>
        </nav>
    </div>

    <a href="proj.php">
        <img class="hp_logo" src="photos for project/Screenshot__113_-removebg-preview.png" alt="" height="95" width="120" align="left" style="margin-top:-1%; margin-left:0%; position: absolute;">
    </a>
    <img class="bg_img" src="photos for project/img1.png" alt="">
    <img class="parents_cap" src="photos for project/par-removebg-preview.png" alt="">

    <div class="frm" style="margin-top: 10%; position: absolute; width: 100%;">
        <form id="reportForm" action="pc_upload.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="form-block">
                    <h2 align="center">Missing Child Information</h2>
                    <div class="form-group">
                        <label for="pc_name">Name of the Child:</label>
                        <input type="text" id="pc_name" name="pc_name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pc_age">Age of the Child:</label>
                        <input type="number" id="pc_age" name="pc_age" min="0" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="missing_place">Place of Missing:</label>
                        <input type="text" id="missing_place" name="missing_place" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="missing_date">Date of Missing:</label>
                        <input type="date" id="missing_date" name="missing_date" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pc_shirt_color">Shirt Color:</label>
                        <input type="text" id="pc_shirt_color" name="pc_shirt_color" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pc_pant_color">Pant Color:</label>
                        <input type="text" id="pc_pant_color" name="pc_pant_color" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pc_gender">Gender:</label>
                        <select id="pc_gender" name="pc_gender" required autocomplete="off">
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pc_identifications">Identifications:</label>
                        <textarea id="pc_identifications" name="pc_identifications" rows="2" required autocomplete="off"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pc_extra_info">Extra Information:</label>
                        <textarea id="pc_extra_info" name="pc_extra_info" rows="2" required autocomplete="off"></textarea>
                    </div>
                </div>
                <div class="form-block">
                    <h2 align="center">Your Information</h2>
                    <div class="form-group">
                        <label for="p_name">Your Name:</label>
                        <input type="text" id="p_name" name="p_name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="p_phone">Your Number:</label>
                        <input type="tel" id="p_phone" name="p_phone" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="p_address">Your Address:</label>
                        <textarea id="p_address" name="p_address" rows="4" required autocomplete="off"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="uploadPhoto">Upload a Photo of the Child:</label>
                        <input type="file" id="uploadPhoto" accept="image/*">
                    </div>
                    <div class="form-group">
                        <button type="button" id="startCamera">Capture a Photo of the Child</button>
                        <button type="button" id="capture" style="display:none;">Capture Photo</button>
                        <button type="button" id="retake" style="display:none;">Retake Photo</button>
                        <div id="videoContainer">
                            <video id="video" autoplay></video>
                            <div id="overlay"></div> <!-- Overlay for human outline -->
                        </div>
                        <canvas id="canvas"></canvas>
                    </div>
                    <img id="photoPreview" src="#" alt="Photo Preview" style="display:none;">
                    <input type="hidden" id="photo" name="photo">
                </div>
            </div>
            <div style="text-align:center;">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>

    <script>
        const startCamera = document.getElementById('startCamera');
        const capture = document.getElementById('capture');
        const retake = document.getElementById('retake');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const photoPreview = document.getElementById('photoPreview');
        const uploadPhoto = document.getElementById('uploadPhoto');
        const videoContainer = document.getElementById('videoContainer');
        const reportForm = document.getElementById('reportForm');
        let stream;

        startCamera.addEventListener('click', async () => {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
            videoContainer.style.display = 'block';
            startCamera.style.display = 'none';
            capture.style.display = 'inline-block';
            retake.style.display = 'inline-block';
        });

        capture.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

            const imageData = canvas.toDataURL('image/png');
            photo.value = imageData;

            videoContainer.style.display = 'none';
            photoPreview.src = imageData;
            photoPreview.style.display = 'block';

            capture.disabled = true; // Disable the capture button after capturing
            stream.getTracks().forEach(track => track.stop());
        });

        retake.addEventListener('click', () => {
            videoContainer.style.display = 'block';
            photoPreview.style.display = 'none';
            startCamera.style.display = 'none';
            capture.style.display = 'inline-block';
            capture.disabled = false; // Enable the capture button when retaking

            if (photo.value) {
                photo.value = ''; // Clear the previous photo value
            }

            startCamera.click(); // Restart the camera
        });

        uploadPhoto.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageData = e.target.result;
                photo.value = imageData;

                videoContainer.style.display = 'none';
                photoPreview.src = imageData;
                photoPreview.style.display = 'block';

                capture.disabled = true; // Disable the capture button if uploading a photo
            };

            reader.readAsDataURL(file);
        });

        reportForm.addEventListener('submit', (event) => {
            if (!photo.value) {
                alert('Please either upload or capture a photo before submitting the form.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
