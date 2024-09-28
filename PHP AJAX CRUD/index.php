<?php
require_once("backend/Students.class.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    require_once("csscdn.php");
    ?>
</head>

<body>
    <div class="container-fluid">
        <h1 class="p-2 text-center bg-primary text-white">Ajax Demo with JQuery And API</h1>


        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Student Management with API</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal"><i class="fa fa-plus"></i></button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped"  id="tabledata">
                        <thead class="table-dark">
                            <tr>
                                <td>ID</td>
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>City</td>
                                <td>Email</td>
                                <td>Gender</td>
                                <td>Action</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                                $result = $student->getAllStudents();

                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<tr>
                                            <td>$row[id]</td>
                                            <td>$row[fname]</td>
                                            <td>$row[lname]</td>
                                            <td>$row[city]</td>
                                            <td>$row[email]</td>
                                            <td>$row[gender]</td>
                                            <td><button type='button' value='$row[id]' class='btn btn-primary btnedit'><i class='fa fa-pen'></i></button>
                                            <button type='button' value='$row[id]' class='btn btn-danger btndelete mx-2'><i class='fa fa-trash'></i></button></td>
                                        </tr>";
                                    }
                                }else{
                                    echo "No Records found in table";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>

<?php
require_once("jscdn.php");
?>

<script src="apiprocess.js"></script>
<script>
    // Jquery code for insert new student
    $(document).on("submit", "#addStudentForm", function(e){
        e.preventDefault();
        let stduentFormData = new FormData(this);
        stduentFormData.append("add_student", true);
        console.log(stduentFormData);

        $.ajax("backend/StudentsAPI.php", {
            method: "post",
            accepts: "Application/json",
            data: stduentFormData,
            processData: false,
            contentType: false,
            success: function(response){
                response = jQuery.parseJSON(response);
                if(response.code === 200){
                    //alert(response.message);
                    $("#addStudentModal").modal("hide");
                    $("#addStudentForm")[0].reset();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);

                    $("#tabledata").load(location.href+" #tabledata");
                }
            }
        });
    });

    // for update student
    $(document).on("submit", "#editStudentForm", function(e){
        e.preventDefault();
        let stduentFormData = new FormData(this);
        stduentFormData.append("update_student", true);
        //console.log(stduentFormData);

        $.ajax("backend/StudentsAPI.php", {
            method: "post",
            accepts: "Application/json",
            data: stduentFormData,
            processData: false,
            contentType: false,
            success: function(response){
                response = jQuery.parseJSON(response);
                console.log(response);
                if(response.code === 200){
                    //alert(response.message);
                    $("#editStudentModal").modal("hide");
                    $("#editStudentForm")[0].reset();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);

                    $("#tabledata").load(location.href+" #tabledata");
                }else{
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(response.message);
                }
            }
        });
    });

    // Code for delete student
    $(document).on("click", ".btndelete", function(e){
        e.preventDefault();
        let id = $(this).val();
        //alert(id);

        if(confirm("are you sure to delete this data ??")){
            $.ajax("backend/StudentsAPI.php", {
                method: "post",
                accepts: "Application/json",
                data:{
                    "delete_student": true,
                    "id": id
                }, 
                success: function(response){
                    response = jQuery.parseJSON(response);
                    if(response.code == 200){
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.message);
                        $("#tabledata").load(location.href+" #tabledata");
                    }else{
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.error(response.message);
                    }
                }
            });
        }
    });

    // code for update student
    $(document).on("click", ".btnedit", function(e){
        e.preventDefault();
        let id = $(this).val();

        $.ajax({
            method: "get",
            url: "backend/StudentsAPI.php?id="+id,
            accepts: "Application/json",
            success: function(response){
                response = jQuery.parseJSON(response);
                if(response.code == 200){
                    $("#update_id").val(response.studentdata.id);
                    $("#update_fname").val(response.studentdata.fname);
                    $("#update_lname").val(response.studentdata.lname);
                    $("#update_city").val(response.studentdata.city);
                    $("#update_email").val(response.studentdata.email);
                    $("#update_gender").val(response.studentdata.gender);

                    $("#editStudentModal").modal("show");
                }else{
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(response.message);
                }
            }
        });
    });
</script>

<!-- Bootstrap Modals -->
<!-- Add Student Modal -->

<div class="modal fade" id="addStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addStudentForm">
            <div class="alert alert-dismissible collapse" id="alertbox">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <p class="message"></p>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="fname" id="insert_fname" placeholder="Enter First Name" class="form-control" required>
                <label for="insert_fname" class="form-label">Enter First Name</label>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="lname" id="insert_lname" placeholder="Enter Last Name" class="form-control" required>
                <label for="insert_lname" class="form-label">Enter Last Name</label>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="city" id="insert_city" placeholder="Enter city" class="form-control" required>
                <label for="insert_city" class="form-label">Enter City</label>
            </div>
            <div class="form-floating my-3">
                <input type="email" name="email" id="insert_email" placeholder="Enter Email Address" class="form-control" required>
                <label for="insert_email" class="form-label">Enter Email Address</label>
            </div>
            <div class="form-floating my-3">
                <select name="gender" id="insert_gender" placeholder="Select Gender" class="form-select" required>
                <option></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                </select>
                <label for="insert_gender" class="form-label">Select Gender</label>
            </div>
            <div class="my-3">
                <input type="submit" value="Add New Student" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-danger">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editStudentForm">
            <div class="alert alert-dismissible collapse" id="alertbox">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <p class="message"></p>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="id" id="update_id" placeholder="Enter Student ID" class="form-control" required readonly>
                <label for="uodate_id" class="form-label">Enter Student ID</label>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="fname" id="update_fname" placeholder="Enter First Name" class="form-control" required>
                <label for="update_fname" class="form-label">Enter First Name</label>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="lname" id="update_lname" placeholder="Enter Last Name" class="form-control" required>
                <label for="update_lname" class="form-label">Enter Last Name</label>
            </div>
            <div class="form-floating my-3">
                <input type="text" name="city" id="update_city" placeholder="Enter city" class="form-control" required>
                <label for="update_city" class="form-label">Enter City</label>
            </div>
            <div class="form-floating my-3">
                <input type="email" name="email" id="update_email" placeholder="Enter Email Address" class="form-control" required>
                <label for="update_email" class="form-label">Enter Email Address</label>
            </div>
            <div class="form-floating my-3">
                <select name="gender" id="update_gender" placeholder="Select Gender" class="form-select" required>
                <option></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                </select>
                <label for="update_gender" class="form-label">Select Gender</label>
            </div>
            <div class="my-3">
                <input type="submit" value="Update Student" class="btn btn-primary">
                <input type="reset" value="Reset" class="btn btn-danger">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>