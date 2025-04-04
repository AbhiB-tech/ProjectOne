<?php

@include '../connection/connection.php';
@include '../css/navbar.php';

$regValue1 = $_SESSION['id'];
$regValue2 = $_SESSION['name'];

$query = "select * from requestshistory where id=$regValue1";
$result = mysqli_query($conn, $query);

$medicines = []; // Initialize medicines array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $symptoms = $_POST['symptoms'];

    // Send request to Python backend
    $url = "http://127.0.0.1:5000/predict"; // Flask API URL
    $data = json_encode(["symptoms" => $symptoms]);

    $options = [
        "http" => [
            "header" => "Content-type: application/json",
            "method" => "POST",
            "content" => $data,
        ],
    ];

    $context = stream_context_create($options);
    $response_json = file_get_contents($url, false, $context);

    if ($response_json === false) {
        echo "<p>Error: Failed to connect to prediction service.</p>";
    } else {
        $response = json_decode($response_json, true);

        if (isset($response['medicines']) && is_array($response['medicines'])) {
            $medicines = $response['medicines'];
        } else {
            echo "<p>Error: Invalid response from prediction service.</p>";
        }

        // Assuming you need these variables from python also, make sure your python returns them.
        $predicted_disease = isset($response['disease']) ? $response['disease'] : null;
        $dis_des = isset($response['description']) ? $response['description'] : null;
        $my_precautions = isset($response['precautions']) ? $response['precautions'] : [];
        $workout = isset($response['workouts']) ? $response['workouts'] : [];
        $my_diet = isset($response['diets']) ? $response['diets'] : [];

    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Health Care Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

<h1 class="mt-4 my-4 text-center text-green">Health Care Center</h1>
<div class="container my-4 mt-4" style="background-color:#192e3f; color: white; border-radius: 15px; padding: 40px;">
    <form method="post">
        <div class="form-group">
            <label for="symptoms">Select Symptoms:</label>
            <input type="text" class="form-control" id="symptoms" name="symptoms" placeholder="type systems such as itching, sleeping, aching etc">
        </div>
        <br>
        <button type="button" id="startSpeechRecognition" class="btn btn-primary" style="margin-left:3px;border:1px solid white; border-radius:20px;">
            Start Speech Recognition
        </button>
        <br>

        <div name="mysysms" id="transcription"></div>
        <br>

        <button type="submit" class="btn btn-danger btn-lg" style="width: 100%; padding: 14px; margin-bottom: 5px;">Predict</button>
    </form>
</div>

<?php if (isset($predicted_disease)) { ?>

    <h1 class="text-center my-4 mt-4">System Predictions</h1>
    <div class="container">
        <div class="result-container">
            <button class="toggle-button" data-bs-toggle="modal" data-bs-target="#diseaseModal" style="padding:4px; margin: 5px 40px 5px 0; font-size:20px;font-weight:bold; width:140px; border-radius:5px; background:#F39334;color:black;">Disease</button>
            <button class="toggle-button" data-bs-toggle="modal" data-bs-target="#descriptionModal" style="padding:4px; margin: 5px 40px 5px 0; font-size:20px;font-weight:bold; width:140px; border-radius:5px; background:#268AF3 ;color:black;">Description</button>
            <button class="toggle-button" data-bs-toggle="modal" data-bs-target="#precautionModal" style="padding:4px; margin: 5px 40px 5px 0; font-size:20px;font-weight:bold; width:140px; border-radius:5px; background:#F371F9 ;color:black;">Precaution</button>
            <button class="toggle-button" data-bs-toggle="modal" data-bs-target="#medicationsModal" style="padding:4px; margin: 5px 40px 5px 0; font-size:20px;font-weight:bold; width:140px;border-radius:5px; background:#F8576F ;color:black;">Medications</button>
            <button class="toggle-button" data-bs-toggle="modal" data-bs-target="#workoutsModal" style="padding:4px; margin: 5px 40px 5px 0; font-size:20px;font-weight:bold; width:140px; border-radius:5px; background:#99F741 ;color:black;">Workouts</button>
            <button class="toggle-button" data-bs-toggle="modal" data-bs-target="#dietsModal" style="padding:4px; margin: 5px 40px 5px 0; font-size:20px;font-weight:bold; width:140px; border-radius:5px; background:#E5E23D;color:black;">Diets</button>
        </div>
    </div>

<?php } ?>

<div class="modal fade" id="diseaseModal" tabindex="-1" aria-labelledby="diseaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #020606; color:white;">
                <h5 class="modal-title" id="diseaseModalLabel">Predicted Disease</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?php echo isset($predicted_disease) ? $predicted_disease : ''; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #020606; color:white;">
                <h5 class="modal-title" id="descriptionModalLabel">Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?php echo isset($dis_des) ? $dis_des : ''; ?></p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="precautionModal" tabindex="-1" aria-labelledby="precautionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #020606; color:white;">
                <h5 class="modal-title" id="precautionModalLabel">Precaution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <?php if (isset($my_precautions)) { foreach ($my_precautions as $i) { echo "<li>" . htmlspecialchars($i) . "</li>"; } }?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="medicationsModal" tabindex="-1" aria-labelledby="medicationsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #020606; color:white;">
                <h5 class="modal-title" id="medicationsModalLabel">Medications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <?php if (isset($medicines)) { foreach ($medicines as $i) { echo "<li>" . htmlspecialchars($i) . "</li>"; } }?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="workoutsModal" tabindex="-1" aria-labelledby="workoutsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #020606; color:white;">
                <h5 class="modal-title" id="workoutsModalLabel">Workouts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <?php if (isset($workout)) { foreach ($workout as $i) { echo "<li>" . htmlspecialchars($i) . "</li>"; } }?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dietsModal" tabindex="-1" aria-labelledby="dietsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #020606; color:white;">
                <h5 class="modal-title" id="dietsModalLabel">Diets</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <?php if (isset($my_diet)) { foreach ($my_diet as $i) { echo "<li>" . htmlspecialchars($i) . "</li>"; } }?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const startSpeechRecognitionButton = document.getElementById('startSpeechRecognition');
    const transcriptionDiv = document.getElementById('transcription');

    startSpeechRecognitionButton.addEventListener('click', startSpeechRecognition);

    function startSpeechRecognition() {
        const recognition = new webkitSpeechRecognition(); // Use webkitSpeechRecognition for compatibility

        recognition.lang = 'en-US'; // Set the language for recognition

        recognition.onresult = function (event) {
            const result = event.results[0][0].transcript;
            transcriptionDiv.textContent = result;
            document.getElementById('symptoms').value=result; //sets the value of the input to the spoken text.
        };

        recognition.onend = function () {
            console.log('Speech recognition ended.');
        };

        recognition.start();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>