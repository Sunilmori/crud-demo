<!DOCTYPE html>
<html>

<head>
    <title>Project</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">User Form</div>
                    <div class="card-body">
                        <form id="form" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="user_id" value="" class="form-control" required>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div><br>

                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <input type="radio" name="gender" value="male" id="male">
                                <label for="male">Male</label>

                                <input type="radio" name="gender" value="female" id="female">
                                <label for="female">Female</label>
                            </div><br>
                            <div class="form-group">
                                <label for="education">Education</label>
                                <input type="text" name="education" id="education" class="form-control" required>
                            </div><br>
                            <div class="form-group">
                                <label for="hobby">Hobbies:</label><br>

                                <input type="checkbox" name="hobby[]" value="reading" id="reading">
                                <label for="reading">Reading</label><br>

                                <input type="checkbox" name="hobby[]" value="writing" id="writing">
                                <label for="writing">Writing</label><br>

                                <input type="checkbox" name="hobby[]" value="coding" id="coding">
                                <label for="coding">Coding</label><br>
                            </div><br>
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <input type="file" name="picture" id="picture" class="form-control">
                                <img src="" id="preview">
                            </div><br>
                            <div class="form-group">
                                <label for="exprience">Exprience</label>
                                <input type="text" name="exprience" id="exprience" class="form-control" required>
                            </div><br>
                            <div class="form-group">
                                <label for="messag">Message</label>
                                <textarea name="messag" id="messag" class="form-control" required></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">AJAX CRUD Operations in Laravel with Modal</h4>
                    </div>
                    <div class="card-body">

                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>gender</th>
                                    <th>education</th>
                                    <th>hobby</th>
                                    <th>exprience</th>
                                    <th>picture</th>
                                    <th>messag</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->education }}</td>
                                    <td>{{ $user->hobby }}</td>
                                    <td>{{ $user->exprience }}</td>
                                    <td><img src="{{asset('storage/app/public/images/'.$user->picture)}}"></td>
                                    <td>{{ $user->message }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary editUser" data-toggle="modal" data-target="#editModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}" onclick="addDataForEdit(this)" data-email="{{ $user->email }}" data-phone="{{ $user->phone }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger deleteUser" onclick="deleteUser(this)" data-id="{{ $user->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script>
        function deleteUser(element) {
            var id = element.closest('tr').children[0].textContent;
            if (id == "") {
                alert("Id is not present.");
                return;
            }
            $.ajax({
                url: "{{ route('deleteRecord') }}",
                type: "DELETE",
                cache: false,
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(dataResult) {
                    dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode) {
                        alert("User deleted successfully");
                    } else {
                        alert("Internal Server Error");
                    }

                }
            });
        }

        function addDataForEdit(element) {
            var currentRow = element.closest('tr').children;
            document.getElementById('user_id').value = currentRow[0].textContent;
            document.getElementById('name').value = currentRow[1].textContent;
            document.getElementById('email').value = currentRow[2].textContent;
            document.getElementById('phone').value = currentRow[3].textContent;
            document.getElementById(currentRow[4].textContent).checked = currentRow[4].textContent;
            document.getElementById('education').value = currentRow[5].textContent;
            var substrings = currentRow[6].textContent.split('-');
            for (var i = 0; i < substrings.length; i++) {
                document.getElementById(substrings[i]).checked = true;
            }
            document.getElementById('exprience').value = currentRow[7].textContent;
            document.getElementById('preview').src = currentRow[8].firstChild.src;
            document.getElementById('messag').value = currentRow[9].textContent;
        }

        function getImgData() {
            const files = chooseFile.files[0];
            if (files) {
                const fileReader = new FileReader();
                fileReader.readAsDataURL(files);
                fileReader.addEventListener("load", function() {
                    imgPreview.style.display = "block";
                    imgPreview.innerHTML = '<img src="' + this.result + '" />';
                });
            }
        }

        // Set Preview Image function
        var preview = $('#preview');
        var profile_picture = $('#picture');
        profile_picture.change(function(event) {
            if (event.target.files.length == 0) {
                return 0;
            }
            var tempURL = URL.createObjectURL(event.target.files[0]);
            preview.attr('src', tempURL);
        });
    </script>


    <script>
        $(document).ready(function() {

            // $(".editUser").click(function(e){
            //     console.log(e.parent("td"));
            // });

            $("#form").submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this); // Create a new FormData object from the form
                var apiUrl = "{{ route('store') }}";
                var apiType = "POST";

                $.ajax({
                    url: apiUrl,
                    type: apiType,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response) {
                            alert('Success.');
                            $('#form')[0].reset();
                            window.location.reload();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('An error occurred while submitting the form.');
                    }
                });
            });
        });



        // $(document).ready(function() {

        //     $(document).on("click", ".editUser", function() {
        //         var id = $(this).data('id');
        //         $.ajax({
        //             url: '/users/' + id,
        //             type: "POST",
        //             cache: false,
        //             data: {
        //                 id: id
        //             },
        //             success: function(dataResult) {
        //                 dataResult = JSON.parse(dataResult);
        //                 if (dataResult.statusCode) {
        //                     window.location = "/userData";
        //                 } else {
        //                     alert("Internal Server Error");
        //                 }

        //             }
        //         });
        //     });
        // });
    </script>
</body>

</html>