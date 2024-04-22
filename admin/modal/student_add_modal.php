<!-- Edit -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-light fa-plus mr-1"></i>Add New Student</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="px-2">
			<form method="POST">
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Card ID</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="uid" value="" placeholder="Input card ID.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">First Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="first_name" value="" placeholder="Input first name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Middle Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="mid_name" value="" placeholder="Input middle name..">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Last Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="last_name" value="" placeholder="Input last name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Extension Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ext_name" value="" placeholder="Input extension name..">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Email</label>
					</div>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="email" value="" placeholder="Input email.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Contact No.</label>
					</div>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="contact" value="" placeholder="Input contact number" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Guardian's Contact No.</label>
					</div>
					<div class="col-sm-8">
						<input type="number" class="form-control" name="guardian_contact" value="" placeholder="Input guardian's contact" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Class</label>
					</div>
					<div class="col-sm-8">
						<select class="form-control custom-select" name="class_id" required>
	                        <option value="" selected disabled>-- Select Class --</option>
	                        <?php
	                                $sqlFetchCLass = "SELECT ct.class_id, CONCAT(pt.program_code,' ', ct.year,'-',ct.section) AS class
														FROM class_tbl ct
														INNER JOIN program_tbl pt ON pt.program_id = ct.program_id
														WHERE ct.deleted = 0
														ORDER BY class ASC";
	                                $resultFetchClass = $conn->query($sqlFetchCLass);

	                                if ($resultFetchClass->num_rows > 0) {
	                                    
	                                    while ($rowFetchClass = $resultFetchClass->fetch_assoc()) {

	                                        $class_id = $rowFetchClass['class_id'];
	                                        $class = $rowFetchClass['class'];
	                                        echo "<option value='$class_id'>$class</option>";
	                                    }
	                                    
	                                } else{
	                                    echo "<option value='none' selected disabled>No class available</option>";
	                                }
	                        ?>
	                    </select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password" value="" placeholder="Input password.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Confirm Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="confirm_password" value="" placeholder="Confirm password.." required>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-success" id="addStudent"></i>Save</a>
			</form>
            </div>

        </div>
    </div>
</div>
