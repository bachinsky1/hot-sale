<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <? //= phpinfo() ?>
    <div id="app">
        <div class="container">

            <!-- Modal -->
            <div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="UserForm" class="needs-validation" novalidate >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="myModalLabel">User creation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <?php if (!empty($allUsers)): ?>
                                    <div class="row">
                                        <div class="col">
                                            <ul>You cannot use emails from this case
                                                <?php foreach ($allUsers as $user): ?>
                                                    <li>
                                                        <?= $user['Email'] ?>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <div class="alert alert-danger" id="Alert" role="alert" style="display: none">
                                    User not created
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="Name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Name" name="Name"
                                            placeholder="Enter your Name" required />
                                        <div class="invalid-feedback">
                                            Please choose a Name.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="Lastname" class="col-sm-2 col-form-label">Lastname</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="Lastname" name="Lastname"
                                            placeholder="Enter your Lastname" required />
                                        <div class="invalid-feedback">
                                            Please choose a Lastname.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="id" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="Email" name="Email"
                                            placeholder="Enter your Email" required />
                                        <div class="invalid-feedback">
                                            Please choose an Email.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="Password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="Password" name="Password"
                                            placeholder="Enter your Password" minlength="8" required />
                                        <div class="invalid-feedback">
                                            Please choose a Password.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="ConfirmPassword" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="ConfirmPassword"
                                            name="ConfirmPassword" placeholder="Confirm your Password"minlength="8" data-match="#Password" required />
                                        <div class="invalid-feedback">
                                            Password not a match.
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="/js/index.js"></script>
</body>

</html>