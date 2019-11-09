<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kiểm tra</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body>

    <?php
    session_start();
    if (!isset($_SESSION["username"]))
        header("location:login.php");

    include_once("models/DanhBa.php");
    include_once("models/Label.php");
    //add DanhBa
    if (isset($_REQUEST["addDanhBa"])) {
        $name = $_REQUEST["name"];
        $phone = $_REQUEST["phone"];
        $email = $_REQUEST["email"];
        $content =  array();
        array_push($content, $name);
        array_push($content, $phone);
        array_push($content, $email);
        DanhBa::addDanhBaToDB($content);
    }

    //edit DanhBa
    if (isset($_REQUEST["editDanhBa"])) {
        $id = $_REQUEST["idId"];
        $name = $_REQUEST["name"];
        $phone = $_REQUEST["phone"];
        $email = $_REQUEST["email"];
        $content =  array();
        array_push($content, $id);
        array_push($content, $name);
        array_push($content, $phone);
        array_push($content, $email);
        //$book = new Book("",$title,$price,$author,$year);
        //$content = $id . "#" . $title . "#" . $price . "#" . $author . "#" . $year;
        DanhBa::editDanhBaDB($content);
    }

    //add label
    if (isset($_REQUEST["addLabel"])) {
        $name = $_REQUEST["labelname"];
        Label::addLabelToDB($name);
    }


    $lsFromDB = DanhBa::getListDanhBaFromDB();
    $lsLabel = Label::getListLabelFromDB();
    ?>

    <div class="container-fluid pl-5" style="display:flex; justify-content: space-between">
        <a href="" style="text-decoration:none;">
            <h1 class="pt-4 pb-2" style=""><i class="fas fa-address-book"></i> Danh bạ </h1>
        </a>
        <div>
            <a href="logout.php" style="text-decoration:none; padding-left:20px;padding-right:20px;font-size:20px;line-height:100px;font-size:20px;"><i class="fas fa-external-link-alt"></i> Đăng Xuất </a>
        </div>
    </div>
    <!-- form thêm contact-->
    <div class="modal" id="form-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Form add DanhBa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" value="" name="name">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" value="" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" value="" name="email">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addDanhBa">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- form sửa contact-->
    <div class="modal" id="form-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit DanhBa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <!-- <input type="hidden" name="action" value="edit"> -->
                        <input type="hidden" id="idId" name="idId">
                        <div class="form-group">
                            <label>ID</label>
                            <input class="form-control" disabled type="text" id="idId1">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" id="idName" name="name">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" id="idPhone" name="phone">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" id="idEmail" name="email">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="editDanhBa">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- form thêm label-->
    <div class="modal" id="form-addLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Form add Label</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Label name</label>
                            <input class="form-control" type="text" value="" name="labelname">
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="addLabel">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="wrapper" class="container-fluid">
        <div id="content-wrapper">
            <div class="container-fluid">

                <!-- DataTables Example -->
                <!-- <div class="card mb-3"> -->
                <!-- <div class="card-header">
                        <i class="fas fa-table"></i>
                        Data Table </div> -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-2 col-lg-3 nav-contact" style="max-width:300px">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <style>
                                        .btn-taolienhe{box-shadow: 0px -1px 15px -9px rgba(0,0,0,0.9);background:#FFFFFF; border-radius:20px;border: none;padding: 10px;outline:0}
                                        .btn-taolienhe:hover {

                                        }
                                    </style>
                                    <button class="btn-taolienhe"  data-toggle="modal" data-target="#form-add"   title="Thêm liên hệ mới" style="padding: 4px 17px;margin-bottom: 11px;" >
                                        <div ></div><span  aria-hidden="true"><svg width="36" height="36" viewBox="0 0 36 36">
                                                <path fill="#34A853" d="M16 16v14h4V20z"></path>
                                                <path fill="#4285F4" d="M30 16H20l-4 4h14z"></path>
                                                <path fill="#FBBC05" d="M6 16v4h10l4-4z"></path>
                                                <path fill="#EA4335" d="M20 16V6h-4v14z"></path>
                                                <path fill="none" d="M0 0h36v36H0z"></path>
                                            </svg></span><span >Tạo liên hệ</span>
                                    </button>
                                </li>
                                <li class="nav-item label-hover">
                                    <a class="nav-link" href="">
                                    <i class="fas fa-address-book"></i> <b> Danh bạ</b>
                                    </a>
                                </li>
                                <style>
                                    .edit-delete-label {
                                        display:none
                                    }
                                    .ed-label:hover .edit-delete-label{
                                        display: block;
                                    }
                                    .ed-label{

                                    }
                                    .label-hover:hover {
                                        background: #F1F3F4;
                                        border-top-right-radius: 15px;
                                        border-bottom-right-radius: 15px;
                                    }
                                </style>
                                <?php
                                foreach ($lsLabel as $key => $value) {
                                    ?>
                                    <li class="nav-item ed-label label-hover" ondrop="drop(event)" ondragover="allowDrop(event)" 
                                        style="display: flex;justify-content: space-between;align-items:center;padding-right:10px;">
                                        <a class="nav-link" href="#" style="color: black;" id="<?php echo $value->id . '-label' ?>" onclick="searchDanhBaByLabel(<?php echo $value->id ?>)">
                                            <svg style="fill:#616161" width="20" height="20" viewBox="0 0 24 24" class="NSy2Hd RTiFqe null"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16zM16 17H5V7h11l3.55 5L16 17z"></path></svg>    
                                            <?php echo $value->labelname ?>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <li class="nav-item label-hover">
                                    <button style="outline:0" class="btn btn-themnhan" type="button" data-toggle="modal" data-target="#form-addLabel"><svg width="30" height="30" viewBox="0 0 24 24" class="NSy2Hd RTiFqe null"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path></svg><b> Tạo nhãn</b></button>
                                </li>
                            </ul>
                        </div>
                        <div id="contentajax" class="col-md-10 col-lg-9">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($lsFromDB as $key => $value) {
                                            ?>
                                            <tr ondragover="allowDrop(event)" draggable="true" id="<?php echo $value->id . '-idDrap' ?>" ondragstart="drag(event)">
                                                <th><?php echo $value->id ?></th>
                                                <td><?php echo $value->name ?></td>
                                                <td><?php echo $value->phonenumber ?></td>
                                                <td><?php echo $value->email ?></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#form-edit" onclick="func(this)" eid="<?php echo $value->id ?>" ename="<?php echo $value->name ?>" ephone="<?php echo $value->phonenumber ?>" eemail="<?php echo $value->email ?>">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" onclick="deleteDanhBa(<?php echo $value->id ?>)">
                                                        <i class="far fa-trash-alt"></i> Delete
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- </div> -->

            </div>
            <!-- /.container-fluid -->


        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- table  -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        function func(a) {

            var eId = a.getAttribute('eid');
            var eName = a.getAttribute('ename');
            var ePhone = a.getAttribute('ephone');
            var eEmail = a.getAttribute('eemail');
            document.getElementById("idId").value = eId;
            document.getElementById("idId1").value = eId;
            document.getElementById("idName").value = eName;
            document.getElementById("idPhone").value = ePhone;
            document.getElementById("idEmail").value = eEmail;

        }
    </script>


    <!-- ajax  -->
    <script>
        function deleteDanhBa(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let a = document.getElementById(id + "-idDrap");
                    a.remove();
                }
            };
            xmlhttp.open("GET", "delete.php?id=" + id, true);
            xmlhttp.send();
        }

        function searchDanhBaByLabel(idlabel) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('contentajax').innerHTML = this.responseText;
                    $('#dataTable').DataTable();
                }
            };
            xmlhttp.open("GET", "searchbylabel.php?idlabel=" + idlabel, true);
            xmlhttp.send();
        }

        function removeLabelFromDanhBa(id) {
            alert(1);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let a = document.getElementById('tr_' + id);
                    a.remove();
                }
            };
            xmlhttp.open("GET", "removelabel.php?id=" + id, true);
            xmlhttp.send();
        }
    </script>

    <!-- drap and drop -->
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            let id_danhba = data.split("-")[0];
            let id_label = ev.target.id.split("-")[0];
            console.log(id_danhba, id_label);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    searchDanhBaByLabel(id_label)
                }

            };
            xmlhttp.open("GET", "addlabel.php?idlabel=" + id_label + "&iddanhba=" + id_danhba, true);
            xmlhttp.send();
        }
    </script>

</body>

</html>