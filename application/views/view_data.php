<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js" integrity="sha512-d6nObkPJgV791iTGuBoVC9Aa2iecqzJRE0Jiqvk85BhLHAPhWqkuBiQb1xz2jvuHNqHLYoN3ymPfpiB1o+Zgpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Hello, world!</title>
  </head>
  <body>
    <?php
    include 'array_search.php';
    ?>
    <!-- As a heading -->
    <nav class="navbar navbar-light bg-light">
      <span class="navbar-brand mb-0 h1">Pitjarus</span>
    </nav>
    <br>
    <div class="container">
      <div class="card ">
        <div class="card-header">
          Grafik
        </div>
        <div class="card-body">
          <a href="<?php echo base_url() ?>" class="btn btn-danger btn-sm">Back</a>
            
          <canvas id="bar-chart" width="100%" height="30%"></canvas>
          <script>
          new Chart(document.getElementById("bar-chart"), {
              type: 'bar',
              data: {
                  labels: [
                  <?php
                    foreach($dataResult as $key => $value) {
                      $persen = round((($value['compliance'] / $rowCount) * 100),4).'%';
                      echo "'".$value['brand']." (".$persen.")"."',";
                    } 
                  ?>
                 
                  ],
                  datasets: [{
                      label: "Compilience",
                      backgroundColor: ["#3e95cd", "#8e5ea2", "orange", "#e8c3b9", "#c45850", "#c45850"],
                      data: [ 
                      <?php
                    foreach($dataResult as $key => $value) {
                      echo "'".$value['compliance']."',";
                    } 
                  ?>
                      ]
                  }]
              },
              options: {
                  legend: {
                      display: true
                  },
                  title: {
                      display: true,
                      text: 'Product Compilience'
                  }
              }
          });
          </script>
        </div>
      </div>
      <br>
      <div class="card ">
        <div class="card-header">
          Tabel
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <th>Brand</th>
              <th>Compliance</th>
            </thead>
            <tbody>
              <?php 

                  foreach ($dataResult as $key => $value) {
                    $persen = round((($value['compliance'] / $rowCount) * 100),4).'%';
                  

               ?>
              <tr>
                <td><?php echo $value['brand'] ?></td>
                <td><?php echo $value['compliance']." (".$persen.")" ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          
        </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
  </body>
</html>