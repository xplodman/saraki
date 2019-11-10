<div class="modal inmodal" id="add_transaction" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add transaction</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_transaction.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="pros_id" class="col-md-2 col-form-label">Prosecution</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <select required name="pros_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <?php
                                        $query = "SELECT
  pros.pros_id,
  pros.pros_name
FROM
  pros";
                                        $results=mysqli_query($con, $query);
                                        ?>
                                        <option value="" disabled selected>Select prosecution</option>
                                        <?php
                                        //loop
                                        foreach ($results as $pros){
                                            ?>
                                            <option value="<?php echo $pros["pros_id"];?>"><?php echo $pros["pros_name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="group_id" class="col-md-2 col-form-label">Group</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <select required name="group_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <?php
                                        $query = "SELECT
  `group`.group_id,
  `group`.group_name
FROM
  `group`";
                                        $results=mysqli_query($con, $query);
                                        ?>
                                        <option value="" disabled selected>Select group</option>
                                        <?php
                                        //loop
                                        foreach ($results as $group){
                                            ?>
                                            <option value="<?php echo $group["group_id"];?>"><?php echo $group["group_name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_id" class="col-md-2 col-form-label">User</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <select required name="user_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <?php
                                        $query = "SELECT
  user.user_id,
  user.user_name
FROM
  user";
                                        $results=mysqli_query($con, $query);
                                        ?>
                                        <option value="" disabled selected>Select user</option>
                                        <?php
                                        //loop
                                        foreach ($results as $user){
                                            ?>
                                            <option value="<?php echo $user["user_id"];?>"><?php echo $user["user_name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="issue_id" class="col-md-2 col-form-label">Issue</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <select required name="issue_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                        <?php
                                        $query = "SELECT
  issue.issue_id,
  issue.issue_name
FROM
  issue";
                                        $results=mysqli_query($con, $query);
                                        ?>
                                        <option value="" disabled selected>Select issue</option>
                                        <?php
                                        //loop
                                        foreach ($results as $issue){
                                            ?>
                                            <option value="<?php echo $issue["issue_id"];?>"><?php echo $issue["issue_name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label">Date</label>
                            <div class="col-md-10 form-group has-danger">
                                <input autocomplete="off" required type="text" name="date" id="date" class="form-control date_autoclose filters" placeholder="date">
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_group" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add group</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_group.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="group_name" class="col-md-2 col-form-label">Group name</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="group_name" id="group_name" class="form-control" placeholder="Group name">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_pros" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add prosecution</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_pros.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="pros_name" class="col-md-2 col-form-label">Prosecution name</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="pros_name" id="pros_name" class="form-control" placeholder="Prosecution name">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_issue" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add issue</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_issue.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="issue_name" class="col-md-2 col-form-label">Issue name</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="issue_name" id="issue_name" class="form-control" placeholder="Issue name">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_user" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add user</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_user.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="user_name" class="col-md-2 col-form-label">User name</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="user_name" id="user_name" class="form-control" placeholder="User name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_phone" class="col-md-2 col-form-label">Phone number</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="user_phone" id="user_phone" class="form-control" placeholder="Phone number">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
