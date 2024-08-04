<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $student_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2 px-0">
            	<div class="row float-left ml-2"><h4 class="modal-title float-left" id="myModalLabel"><i class="fa-solid fa-pen-to-square mr-1"></i>Edit Student</h4></div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <div class="modal-body">
			<div class="px-2">
			<form method="POST">
				<input type="hidden" class="form-control" name="student_id" value="<?php echo $student_id; ?>" required>
				<input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Card ID</label>
					</div>
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="old_uid" value="<?php echo $uid; ?>" required>
						<input type="text" class="form-control" id="uid_<?php echo $student_id; ?>" name="uid" value="<?php echo $uid; ?>" placeholder="Input card ID.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">First Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" placeholder="Input first name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Middle Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="mid_name" value="<?php echo $middle_name; ?>" placeholder="Input middle name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Last Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" placeholder="Input last name.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Extension Name</label>
					</div>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ext_name" value="<?php echo $ext_name; ?>" placeholder="Input extension name..">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Email</label>
					</div>
					<div class="col-sm-8">
						<input type="hidden" class="form-control" name="old_email" value="<?php echo $email; ?>" required>
						<input type="email" class="form-control" id="email_<?php echo $student_id; ?>" name="email" value="<?php echo $email; ?>" placeholder="Input email.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Contact No.</label>
					</div>
					<div class="col-sm-8">
						<input type="number" class="form-control contact-input" name="contact" value="<?php echo $contact; ?>" placeholder="Input contact number.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Guardian's Contact No.</label>
					</div>
					<div class="col-sm-8">
						<input type="number" class="form-control contact-input" name="guardian_contact" value="<?php echo $guardian_contact; ?>" placeholder="Input guardian's contact.." required>
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

	                                        $class_ids = $rowFetchClass['class_id'];
	                                        $class = $rowFetchClass['class'];
	                                        $selected = ($class_ids == $class_id) ? 'selected' : '';
	                                        echo "<option value='$class_ids' $selected>$class</option>";
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
						<input type="password" class="form-control" id="password_<?php echo $student_id; ?>" name="password" value="" placeholder="Input password.." required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-4">
						<label class="control-label modal-label">Confirm Password</label>
					</div>
					<div class="col-sm-8">
						<input type="password" class="form-control" id="confirm_password_<?php echo $student_id; ?>" name="confirm_password" value="" placeholder="Confirm password.." required>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-success" id="updateStudent_<?php echo $student_id; ?>"></i>Update</a>
            </div>
            </form>
        </div>
    </div>
</div>
