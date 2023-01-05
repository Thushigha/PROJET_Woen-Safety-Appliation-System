<?php
session_start();
include 'header.php';

if (empty($_SESSION['user_id'])) {
  header('Location: sign-in.php');
}

if ($_SESSION['role'] != 'admin') {
  header('Location: dashboard.php');
}
?>

<?php include 'sidenav.php'; ?>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Users</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Users</h6>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Type here...</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <ul class="navbar-nav  justify-content-end">
          <li class="nav-item d-flex align-items-center">

          </li>
          <?php if (isset($_SESSION['user_id'])) : ?>
            <li class="nav-item d-flex align-items-center">
              <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
          <?php endif; ?>
          <?php if (!isset($_SESSION['user_id'])) : ?>
            <li class="nav-item d-flex align-items-center">
              <a href="sign-in.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">

    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Users </h6>
              <div class="col-6 text-end">
                <a class="btn bg-gradient-dark mb-0" href="add_user.php"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New User</a>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <?php
              // Include config file
              require_once "dbcon.php";

              // Attempt select query execution
              $sql = "SELECT * FROM users";
              if ($result = $pdo->query($sql)) {
                if ($result->rowCount() > 0) {
                  echo '<table class="table align-items-center justify-content-center mb-0">';
                  echo "<thead>";
                  echo "<tr>";
                  echo '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>';
                  echo '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>';
                  echo '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>';
                  echo '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>';
                  echo '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mobile</th>';
                  echo '<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>';
                  echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                  while ($row = $result->fetch()) {
                    echo "<tr>";
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>";
                    echo '<a href="user_update.php?id=' . $row['id'] . '" class="px-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    echo '<a href="user_delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    echo "</td>";

                    echo "</tr>";
                  }
                  echo "</tbody>";
                  echo "</table>";
                  // Free result set
                  unset($result);
                } else {
                  echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                }
              } else {
                echo "Oops! Something went wrong. Please try again later.";
              }

              // Close connection
              unset($pdo);
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  </div>
</main>
<?php include 'footer.php'; ?>