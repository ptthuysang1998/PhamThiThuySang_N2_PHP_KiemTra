<?php
    include_once("models/DanhBa.php");
    $id_label = $_REQUEST["idlabel"];
    $lsDanhba = DanhBa::searchDanhBaByLabel($id_label);
?>
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
                foreach ($lsDanhba as $key => $value) {
                    ?>
                <tr id="<?php echo "tr_" ?><?php echo $value->id ?>">
                        <th ><?php echo $value->id ?></th>
                        <td><?php echo $value->name ?></td>
                        <td ><?php echo $value->phonenumber?></td>
                        <td ><?php echo $value->email ?></td>
                        <td> 
                            <div class="btn-group"  role="group" aria-label="Basic example">
                                <button class="btn btn-secondary" 
                                    data-toggle="modal" data-target="#form-edit"
                                    onclick="func(this)"
                                    eid="<?php echo $value->id ?>"
                                    ename="<?php echo $value->name ?>"
                                    ephone="<?php echo $value->phonenumber ?>"
                                    eemail="<?php echo $value->email ?>"
                                >
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="button" 
                                    class="btn btn-danger" 
                                    onclick="deleteDanhBa(<?php echo $value->id ?>)"
                                >
                                    Delete
                                </button>
                                <button type="button" 
                                    class="btn btn-info" 
                                    onclick="removeLabelFromDanhBa(<?php echo $value->id ?>)"
                                >
                                    Remove Label
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