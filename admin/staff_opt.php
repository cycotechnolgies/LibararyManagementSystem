<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="row">
    <div class="card shadow mb-3">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="user_id"><strong>user ID</strong></label>
                            <input id="user_id" class="form-control" type="text" placeholder="U001" name="user_id" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="user_name"><strong>User Name</strong></label>
                            <input id="user_name" class="form-control" type="text" placeholder="Saman_kumara" name="user_name" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="first_name"><strong>First Name</strong></label>
                            <input id="first_name" class="form-control" type="text" placeholder="John" name="first_name" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                            <input id="last_name" class="form-control" type="text" placeholder="Doe" name="last_name" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="email"><strong>Email</strong></label>
                            <input id="email" class="form-control" type="email" placeholder="email" name="email" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="password"><strong>Password</strong></label>
                            <input id="password" class="form-control" type="password" placeholder="********" name="password" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="confirm_password"><strong>Confirm Password</strong></label>
                            <input id="confirm_password" class="form-control" type="password" placeholder="********" name="confirm_password" />
                        </div>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button class="btn btn-primary btn-md" type="submit">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="content">
    <div class="custom-container">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Here you would add your PHP logic to generate rows dynamically -->
                    <tr>
                        <td>U001</td>
                        <td>Harry Potter</td>
                        <td>harry@gmail.com</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-success btn-sm"><i class="fas fa-edit"></i></button>
                                <button  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Repeat this row structure for each member -->
                </tbody>
            </table>
        </div>
    </div>
</section>

    
</body>
</html>
