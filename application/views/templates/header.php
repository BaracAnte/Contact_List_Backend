<!DOCTYPE html>
<html>

<head>
  <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
  <title>Contact list</title>
  <!-- <link rel="stylesheet" href="/assets/css/bootstrap.css"> -->
  <link rel="stylesheet" href="/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar  -->
      <nav class="col-md-2 d-none d-md-block border-right sidebar">
        <div class="nav-item py-4 px-2">
          <h2>
            <img src="/assets/images/revendo_logo.png" class="img">
            revendo
          </h2>
        </div>
        <ul class="list-unstyled components">
          <li class="nav-item py-2">
            <a class="nav-link create_btn" href="/contacts/add_edit">
              <i class="fa fa-plus px-2" aria-hidden="true"></i>
              New contact
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="/contacts/index">
              <i class="fa fa-home px-2" aria-hidden="true"></i>
              All contacts
            </a>
          </li>
          <li class="nav-item py-2">
            <a class="nav-link" href="/contacts/favorites">
              <i class="fa fa-heart-o px-2" aria-hidden="true"></i>
              My favorites
            </a>
          </li>
      </nav>
      <div class="col-md-9 ml-sm-auto col-lg-9 pt-3 px-4">