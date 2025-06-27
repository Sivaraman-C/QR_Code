<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style type="text/css">
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0; 
        }
    </style>

    <title>QR Code Generator</title>
  </head>
  <body>

    <div class="container">

        <center><h1 class="display-5 mb-24">Company Profile QR Generator</h1></center>

        <form method="POST">
        <div class="mb-3">
        <label class="form-label">Teacher Name</label>
        <input type="text" class="form-control" id="company_name" name="teacher_name" required>
        </div>

        <div class="mb-3">
        <label class="form-label">Date Of Birth</label>
        <input type="date" class="form-control" id="date_of_Birth" name="date_of_Birth" required>
        </div>

        <div class="mb-3">
        <label class="form-label">Gender</label>
        <input type="text" class="form-control" id="gender" name="gender" required>
        </div>
        <div class="mb-3">
        <label class="form-label">Blood Group</label>
        <input type="text" class="form-control" id="blood_group" name="blood_group" required>
        </div>
        <div class="mb-3">
        <label class="form-label">EmployeeID</label>
        <input type="text" class="form-control" id="employeeID" name="employeeID" required>
        </div>
        <div class="mb-3">
        <label class="form-label">Designation</label>
        <input type="text" class="form-control" id="designation" name="designation" required>
        </div>
        <div class="mb-3">
        <label class="form-label">Father/Spouse</label>
        <input type="text" class="form-control" id="father_spouse_name" name="father_spouse_name" required>
        </div>
        <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" required>
        </div>

        <div class="mb-3">
        <label class="form-label">Contact No.</label>
        <input type="number" class="form-control" id="contact_number" name="contact_number" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" required>
        </div>

        <div class="mb-3">
        <label class="form-label">E-Mail</label>
        <input type="text" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
        <label class="form-label">Emergency Contat Person</label>
        <input type="text" class="form-control" id="emer_contat_person" name="emer_contat_person" required>
        </div>

        <div class="mb-3">
        <label class="form-label">Relation</label>
        <input type="text" class="form-control" id="relation" name="relation" required>
        </div>

        <div class="mb-3">
        <label class="form-label">Emergency Contact No.</label>
        <input type="number" class="form-control" id="emer_contact_number" name="emer_contact_number" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" required>
        </div>

        
        <button type="submit" name="generateQR" class="btn btn-primary float-end">Generate QR</button>
        </form>

    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>


 <?php

    include('phpqrcode/qrlib.php');

    $teacherName = $_POST['teacher_name'];
    $dob = $_POST['date_of_Birth'];
    $gender = $_POST['gender'];
    $bloodgroup = $_POST['blood_group'];
    $empID = $_POST['employeeID'];
    $designation = $_POST['designation'];
    $fatherspouse = $_POST['father_spouse_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact_number'];
    $email = $_POST['email'];
    $emerContactPerson = $_POST['emer_contat_person'];
    $relation = $_POST['relation'];
    $emerContactNumber = $_POST['emer_contact_number'];

    // how to save PNG codes to server
    
    $tempDir = "qrcodes/";
    
    $codeContents = "Teacher Name: "." ".$teacherName."\n"."Date Of Birth: ".$dob. "\n". "Gender: ".$gender. "\n". "Blood Group: "." ".$bloodgroup."\n"."EmployeeID: ".$empID."\n"."Designation: ".$designation. "\n". "Father Spouse Name: ".$fatherspouse. "\n". "Address: ".$address. "\n". "Contact: ".$contact. "\n". "E-Mail: ".$email. "\n". "Emergency Contact Person: ".$emerContactPerson. "\n". "Relation: ".$relation. "\n". "Emergency Contact Number: " .$emerContactNumber;
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = 'QR'.rand(2,1000).'_'.$teacherName.'.png';

    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;

    if(isset($_POST['generateQR']))
    {

        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath);
            echo 'File generated!';
            echo '<hr />';
        } else {
            echo 'File already generated! We can use this cached file to speed up site on common codes!';
            echo '<hr />';
        }
        
        echo 'Server PNG File: '.$pngAbsoluteFilePath;
        echo '<hr />';
        
        // displaying
        echo '<img src="'.$urlRelativeFilePath.'" />';
    }
    
    ?>
