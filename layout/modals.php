<font face="myFirstFont">
    <div class="modal inmodal" id="adduser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a user</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertuser.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10"><input type="text" class="form-control" name="username"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Job</label>
                            <div class="col-sm-10"><div class="input-group"><select class="chosen-select form-control" name="jobid">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM job";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $job){
                                            ?>
                                            <option value="<?php echo $job["jobid"];?>"><?php echo $job["jobname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select> <span class="input-group-btn">
                                                    <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addjob">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    </span></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Domain/App ID</label>

                            <div class="col-sm-10"><input type="text" class="form-control" name="userappid"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Domain/App PW</label>

                            <div class="col-sm-10"><input type="text" class="form-control" name="userapppw"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Prosecution</label>
                            <div class="col-sm-10"><div class="input-group"><select class="chosen-select form-control" name="prosecutionid" onchange="getId(this.value);">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM prosecution";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $prosecution){
                                            ?>
                                            <option value="<?php echo $prosecution["prosecutionid"];?>"><?php echo $prosecution["prosecutionname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select> <span class="input-group-btn">
                                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addpros">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </span></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        Hardware
                        <div class="form-group"><label class="col-sm-2 control-label">Choose an item</label>
                            <div class="col-sm-10"><div class="input-group"> <select id="hardwarelist" class="form-control dual_select" name="hardwareid[]" multiple >
                                    </select> <span class="input-group-btn">
                                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#additem">
                                                        <i class="fa fa-plus"></i>
                                                    </button> </span></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info"  type="Submit"  name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addexport" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Insert export receipt</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertreceipt.php" class="form-horizontal"  multipart="" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="2">
                        <div class="form-group"><label class="col-sm-2 control-label">To</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select required="required" class="chosen-select form-control" name="toid">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM prosecution";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $prosecution){
                                            ?>
                                            <option value="<?php echo $prosecution["prosecutionid"];?>"><?php echo $prosecution["prosecutionname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addpros"><i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sign</label>
                            <div class="col-sm-10">
                                <input name="receiptsign" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        Images
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="file" name="userfile[]" multiple/>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        Items
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Choose an item</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select id="hardwarelist" class="form-control dual_select" name="ownitemid[]" multiple >
                                        <?php
                                        $prosecution = $_POST["prosecution"];
                                        $query="
Select ownitem.ownitemname,
  owncategory.owncategoryname,
  ownitem.ownitemid
From ownitem
  Inner Join owncategory On owncategory.owncategoryid = ownitem.owncategoryid
Where ownitem.ownitemtype = '1'";
                                        $results = mysqli_query($con, $query);
                                        foreach ($results as $ownitem){
                                            ?>
                                            <option value="<?php echo $ownitem["ownitemid"];?>"><?php echo $ownitem["owncategoryname"]." - ".$ownitem["ownitemname"];?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#additem">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info"  type="Submit"  name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="additem" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert hardware item</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertitem.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <div class="input-group"><select required="required" name="categoryname" class="chosen-select" form-control">
                                    <option></option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT * FROM `category`");
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['categoryid'] ?>"> <?php echo $row['categoryname']?> </option>
                                    <?php } ?>
                                    </select> <span class="input-group-btn"> <button
                                                class="btn btn-primary " type="button"
                                                data-toggle="modal" data-target="#addcat"><i
                                                    class="fa fa-plus"></i></button>
                                                    </span></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10"><input required="required" name="hardwarename" type="text" class="form-control"><span
                                        class="help-block m-b-none">Like (HP - Dell - Canon - etc)</span>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">serial</label>
                            <div class="col-sm-10"><input name="hardwaresn" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">IP</label>
                            <div class="col-sm-10"><input name="hardwareip" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Store in</label>
                            <div class="col-sm-10">
                                <div class="input-group"><select required="required" class="chosen-select form-control" name="prosecution">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM prosecution";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $prosecution){
                                            ?>
                                            <option value="<?php echo $prosecution["prosecutionid"];?>"><?php echo $prosecution["prosecutionname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select> <span class="input-group-btn"> <button
                                                class="btn btn-primary " type="button"
                                                data-toggle="modal" data-target="#addpros"><i
                                                    class="fa fa-plus"></i></button>
                                                    </span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addjob" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rollIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a job</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertjob.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="jobname" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addimport" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert import receipt</h4>
                </div>
                <div class="modal-body">
                    Information
                    <form method="post" action="php/insertreceipt.php" class="form-horizontal"  multipart="" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">From</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="chosen-select form-control" name="fromid">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM `from`";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $from){
                                            ?>
                                            <option value="<?php echo $from["fromid"];?>"><?php echo $from["fromname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addfrom">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sign</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select class="chosen-select form-control" name="receiptsign">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM `administrator`";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $administrator){
                                            ?>
                                            <option value="<?php echo $administrator["administratorid"];?>"><?php echo $administrator["administratorname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addadministrator">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="data_1">
                            <label class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <input type="text" class="form-control" name="date">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        Images
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="file" name="userfile[]" multiple/>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        Items
                        <div class="right">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addowncategory">
                                <i class="fa fa-plus">Add a new category</i>
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Item</label>
                            <div class="col-sm-10">
                                <div class="form-inline">
                                    <div class="field_wrapper">
                                        <div>
                                            <input style="width: 50px" type="text" class="form-control" name="itemquantity[]"/>
                                            <select class="chosen-select2 form-control" name="itemcategory[]">
                                                <option></option>
                                                <?php
                                                $query6 = "SELECT * FROM `owncategory`";
                                                $results6=mysqli_query($con, $query6);
                                                //loop
                                                foreach ($results6 as $owncategory){
                                                    ?>
                                                    <option value="<?php echo $owncategory["owncategoryid"];?>"><?php echo $owncategory["owncategoryname"];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="text" style="width: 250px" placeholder="item name" class="form-control" name="itemname[]">
                                            <button class="btn btn-primary add_button" type="button">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info"  type="Submit"  name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addfrom" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rollIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert from destination</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertfrom.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="fromname" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addowncategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rollIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a new category</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertowncategory.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="owncategoryname" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addadministrator" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a administrator</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertadministrator.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="administratorname" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">App ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="administratorappid" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">App PW</label>
                            <div class="col-sm-10">
                                <input type="text" name="administratorapppw" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Choose prosecution</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select id="hardwarelist" class="form-control dual_select" name="prosecutionid[]" multiple >
                                        <?php
                                        $query="
Select prosecution.prosecutionid,
  prosecution.prosecutionname,
  administrator_has_prosecution.status
From prosecution
  Left Join administrator_has_prosecution
    On administrator_has_prosecution.prosecutionid = prosecution.prosecutionid
WHERE ( administrator_has_prosecution.prosecutionid IS NULL or administrator_has_prosecution.status = 0)";
                                        $results = mysqli_query($con, $query);
                                        foreach ($results as $freepros){
                                            ?>
                                            <option value="<?php echo $freepros["prosecutionid"];?>"><?php echo $freepros["prosecutionname"];?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#addpros">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="additem" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert hardware item</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertitem.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <div class="input-group"><select required="required" name="categoryname" class="chosen-select" form-control">
                                    <option></option>
                                    <?php
                                    $result = mysqli_query($con, "SELECT * FROM `category`");
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $row['categoryid'] ?>"> <?php echo $row['categoryname']?> </option>
                                    <?php } ?>
                                    </select> <span class="input-group-btn"> <button
                                                class="btn btn-primary " type="button"
                                                data-toggle="modal" data-target="#addcat"><i
                                                    class="fa fa-plus"></i></button>
                                                    </span></div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10"><input required="required" name="hardwarename" type="text" class="form-control"><span
                                        class="help-block m-b-none">Like (HP - Dell - Canon - etc)</span>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">serial</label>

                            <div class="col-sm-10"><input name="hardwaresn" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">IP</label>

                            <div class="col-sm-10"><input name="hardwareip" type="text" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Store in</label>
                            <div class="col-sm-10">
                                <div class="input-group"><select required="required" class="chosen-select form-control" name="prosecution">
                                        <option></option>
                                        <?php
                                        $query = "SELECT * FROM prosecution";
                                        $results=mysqli_query($con, $query);
                                        //loop
                                        foreach ($results as $prosecution){
                                            ?>
                                            <option value="<?php echo $prosecution["prosecutionid"];?>"><?php echo $prosecution["prosecutionname"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select> <span class="input-group-btn"> <button
                                                class="btn btn-primary " type="button"
                                                data-toggle="modal" data-target="#addpros"><i
                                                    class="fa fa-plus"></i></button>
                                                    </span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addcat" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rollIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert category</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertcat.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10"><input name="categoryname" type="text" class="form-control"><span
                                        class="help-block m-b-none">Like (Case - Monitor - Scanner - etc)</span></div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addpros" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rollIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert prosecution</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertpros.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input name="prosecutionname" type="text" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="addservertomonitor" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated rollIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">Insert a item to monitor</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="php/insertservertomonitor.php" class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Server name</label>
                            <div class="col-sm-10">
                                <input name="servername" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Server IP</label>
                            <div class="col-sm-10">
                                <input name="serverip" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Server monitor type</label>
                            <div class="col-sm-10">
                                <div class="col-sm-10">
                                    <label class="radio-inline">
                                        <input required type="radio" name="servermonitortype" id="servermonitortype" value="1"  onclick="document.getElementById('serverport').disabled=this.checked">Ping
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="servermonitortype" id="servermonitortype" value="2"  onclick="document.getElementById('serverport').disabled=!this.checked">Telnet
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Server port</label>
                            <div class="col-sm-10">
                                <input name="serverport" disabled id="serverport" type="text" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                    <button class="btn btn-info" type="Submit" name="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</font>
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
