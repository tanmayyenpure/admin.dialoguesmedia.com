function addData(){
    var studata = $("usname").val();
    var studata1 = $("usdeg").val();
    var studata2 = $("uscom").val();
    var studata3 = $("usadd").val();
    var studata4 = $("usnum").val();
    console.log(studata);
    console.log(studata1);
    console.log(studata2);
    console.log(studata3);
    console.log(studata4);
    
}


const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snap = document.getElementById('snap');
    const retakeButton = document.getElementById('retake');
    const uploadButton = document.getElementById('upload');
    const errorMsgElement = document.getElementById('span#ErrorMsg');

    let captureMode = 0; // 0: Camera not open, 1: Camera open, 2: Photo captured

    snap.addEventListener('click', () => {
        if (captureMode === 0) {
            // First click opens the camera
            openCamera();
        } else if (captureMode === 1) {
            // Second click captures the photo
            capturePhoto();
        } else if (captureMode === 2) {
            // Third click shows the action buttons
            showActionButtons();
        }
    });

    retakeButton.addEventListener('click', () => {
        // Clicking "Retake" button resets the process

        resetCapture();
        context.drawImage(video, 0, 0, 120, 120);
        canvas.style.display = 'block';
    });

    uploadButton.addEventListener('click', () => {
        // Implement photo upload logic here (not provided in this code)
        // You can send the image to the server, display it on the page, or perform any other action.
        // For simplicity, we will just reset the process here.
        resetCapture();
    });

    function openCamera() {
        const constraints = {
            audio: false,
            video: {
                width: 120,
                height: 120
            }
        };

        async function init() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                handleSuccess(stream);
                captureMode = 1;
                snap.textContent = 'Capture Photo';
            } catch (e) {
                errorMsgElement.innerHTML = `navigator.getUserMedia.error: ${e.toString()}`;
            }
        }

        init();
    }

    function handleSuccess(stream) {
        window.stream = stream;
        video.srcObject = stream;
    }

    var context = canvas.getContext('2d');

    function capturePhoto() {
        context.drawImage(video, 0, 0, 120, 120);
        captureMode = 2;
        snap.textContent = 'Show Action Buttons';
        document.getElementById('snap').style.display = 'none'
        document.getElementById('retake').style.display = 'block';
        document.getElementById('upload').style.display = 'block';

        canvas.style.display = 'block';
    }

    function showActionButtons() {
    }

    function resetCapture() {
        captureMode = 0;
        snap.textContent = 'Open Camera';
        canvas.style.display = 'none';
        document.getElementById('snap').style.display = 'none';
    }


  

    function changeContent() {
        var d = new Date();
        document.getElementById('year').options[0].text = d.getFullYear();
        document.getElementById('month').options[0].text = (d.getMonth() + 1);
        document.getElementById('days').options[0].text = d.getDate();
    }

    function validateDOB1() {

        var year = document.getElementById('year').value
        console.log(year)
        var day = document.getElementById('days').value
        console.log(day)
        var month = document.getElementById('month').value
        console.log(month)
        var dob = new Date(year, month - 1, day);
        var today = new Date();
        var birthDate = dob;
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (age < 21) {
            alert('You are not eligible. Age should be above 21...!!!')
        }
    }