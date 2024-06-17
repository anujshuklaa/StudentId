<?php 
$notfound = false;
include 'config.php';
$html = '';
if(isset($_POST['search'])){
     $id_no = $_POST['id_no'];
     $sql = "Select * from cards where id_no='$id_no'";
     $result = mysqli_query($conn, $sql);
     if(mysqli_num_rows($result)>0){
         $html="<div class='card' style='width:100%; padding:0;'>";
         while($row=mysqli_fetch_assoc($result)){
            $name = $row["name"];
            $id_no = $row["id_no"];
            $grade = $row['grade'];
            $dob = $row['dob'];
            $address = $row['address'];
            $email = $row['email'];
            $phone = $row['phone'];
            $image = $row['image'];
            $date = date('Y', strtotime($row['date']));
            $html.="
                <div class='container' style='text-align:left;'>
                    <div class='row'>
                        <div class='col-12 text-center'>
                            <div class='logo'>
                                <img src='logo.jpg' alt='Logo' class='img-fluid' />
                            </div>
                            <a>Feroze Gandhi Institute of Engineering and Technology</a>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-4'>
                            <img src='$image' class='img-fluid rounded border' alt='Student Image' />
                        </div>
                        <div class='col-8'>
                            <h2>$name</h2>
                            <p>Student</p>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-6'>
                            <div>
                                <h4>Roll No</h4>
                                <p>$id_no</p>
                            </div>
                        </div>
                        <div class='col-6'>
                            <div>
                                <h4>Phone</h4>
                                <p>$phone</p>
                            </div>
                        </div>
                        <div class='col-6'>
                            <div>
                                <h4>Session</h4>
                                <p>$date</p>
                            </div>
                        </div>
                        <div class='col-6'>
                            <div>
                                <h4>Address</h4>
                                <p>$address</p>
                            </div>
                        </div>
                        <div class='col-12 text-center'>
                            <div>
                                <br>
                                <p style='font-size:12px;'>Director Sign</p>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Card Generation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        span {
            font-family: 'Orbitron', sans-serif;
            font-size: 16px;
        }
        .container {
            
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }
        .logo img {
            max-width: 50px;
        }
        .header {
            text-align: center;
        }
        .row > .col-4 img {
            max-width: 100%;
            height: auto;
        }
        .row > .col-8 h2 {
            font-size: 1.5rem;
        }
        .row > .col-8 p {
            font-size: 1rem;
        }
        .row > .col-6 h4 {
            font-size: 1rem;
            color: #b37400;
        }
        .sign p {
            font-size: 12px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-image: linear-gradient(to right, rgb(0,300,255), rgb(93,4,217));">
  <a class="navbar-brand" href="#"><img src="assets/images/codingcush-logo.png" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<br>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="card jumbotron">
        <div class="card-body">
          <form method="POST" action="id-card.php">
            <label for="id_no">Student Id Card No.</label>
            <input class="form-control" type="text" placeholder="Enter Id Card No." name="id_no" id="id_no">
            <small class="form-text text-muted">Every student's should have unique Id no.</small>
            <br>
            <button class="btn btn-outline-primary" type="submit" name="search">Generate</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Here is your Id Card
        </div>
        <div class="card-body" id="mycard">
          <?php echo $html ?>
        </div>
        <br>
        <button id="demo" class="downloadtable btn btn-primary" onclick="downloadtable()">Download Id Card</button>
        <input type="button" value="Print this page" class="btn btn-secondary" onclick="printPage()" />
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
function downloadtable() {
    var node = document.getElementById('mycard');
    domtoimage.toPng(node)
        .then(function (dataUrl) {
            var img = new Image();
            img.src = dataUrl;
            downloadURI(dataUrl, "student-id-card.png")
        })
        .catch(function (error) {
            console.error('oops, something went wrong', error);
        });
}

function downloadURI(uri, name) {
    var link = document.createElement("a");
    link.download = name;
    link.href = uri;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function printPage() {
    window.print();
}
</script>
</body>
</html>
