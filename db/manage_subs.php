<style>
		.block {
			display: none;
		}
	</style>

<script>
  function showBlock() {
			var option = document.querySelector('input[name="option"]:checked').value;
			var block = document.querySelector('#block' + option.substring(option.length - 1));
			if (block) {
				var blocks = document.querySelectorAll('.block');
				for (var i = 0; i < blocks.length; i++) {
					blocks[i].style.display = 'none';
				}
				block.style.display = 'block';
			}
		}
		function manageBlock() {
			var option = document.querySelector('input[name="mng"]:checked').value;
			var block = document.querySelector('#manage_subs' + option.substring(option.length - 1));
			if (block) {
				var blocks = document.querySelectorAll('.manage_subs');
				for (var i = 0; i < blocks.length; i++) {
					blocks[i].style.display = 'none';
				}
				block.style.display = 'block';
			}
		}
    function subtypeBlock() {
			var option = document.querySelector('input[name="subtype"]:checked').value;
			var block = document.querySelector('#subtype' + option.substring(option.length - 1));
			if (block) {
				var blocks = document.querySelectorAll('.subtype');
				for (var i = 0; i < blocks.length; i++) {
					blocks[i].style.display = 'none';
				}
				block.style.display = 'block';
			}
		}
	</script> 


<?php
if(isset($_GET['btn'])){
    
    $select_fac = "SELECT emp_no, emp_name FROM faculty_details";
    $fac = $conn->query($select_fac);

    // echo '<h3>Add Subs</h3>';
?>
<div class="MANAGE_SUBJECTS">
  <label><input type="radio" name="mng" value="option1" onclick="manageBlock()">ADD NEW SUBJECTS</label>
	<label><input type="radio" name="mng" value="option2" onclick="manageBlock()">EDIT SUBJECTS</label>
</div>
  

<div class="manage_subs" id="manage_subs1" style="display:none">
<form action="" method="post" align="center" id="fm" class="fm">
    <div class="container">
      <h2 class="header text-center py-3">Add SUBJECTS</h2>

      <label><input type="radio" name="option" value="option1" onclick="showBlock()">DEGREE</label>
	    <label><input type="radio" name="option" value="option2" onclick="showBlock()">DIPLOMA</label>
      <div class="form-group">
        <label for="name"><b>SUBJECT CODE</b></label>
        <input type="text" placeholder="Enter SUBJECT CODE" name="SUBJECT_CODE" id="SUBJECT_CODE" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="phone"><b>SUBJECT NAME</b></label>
        <input type="text" placeholder="Enter SUBJECT NAME" name="SUBJECT_NAME" id="SUBJECT_NAME" class="form-control" required>
      </div>

      <div class="block" id="block1" style="Display:none">
        <label for="erno"><b>DEGREE</b></label>
        <select name="class_deg">
            <option value="1TK">1TK</option>
            <option value="2TK">2TK</option>
            <option value="3TK">3TK</option>
            <option value="4TK">4TK</option>
            <option value="5TK">5TK</option>
            <option value="6TK">6TK</option>
            <option value="8TK">8TK</option>
        </select>
      </div>
      <div class="block" id="block2" style="Display:none">
      <label for="erno"><b>DIPLOMA</b></label>
      <select name="class_dip">
                <option value="1DK">1DK</option>
                <option value="2DK">2DK</option>
                <option value="3DK">3DK</option>
                <option value="4DK">4DK</option>
                <option value="5DK">5DK</option>
                <option value="6DK">6DK</option>
        </select>
      </div>
     
      <div class="form-group">
        <label for="email"><b>ASSIGN FACULTY</b></label>
        <input list="ASSIGN_FAC" name="ASSIGN_FACULTY" id="ASSIGN_FACULTY" class="form-control" required>
            <datalist id="ASSIGN_FAC">

              <?php
                while($got_fac = mysqli_fetch_array($fac, MYSQLI_ASSOC)){
                    $emp_id = $got_fac['emp_no'];
                    $emp_name = $got_fac['emp_name'];
            ?>

                    <option value="<?php echo $emp_id ?>"><?php echo $emp_name ?></option>

            <?php
                }
              ?>

            </datalist>
      </div>
      <div class="form-group">
        <label for="psw"><b>ELECTIVE:</b></label>
        YES<input type="radio" placeholder="Enter Password" value="yes" name="ELECTIVE" id="ELECTIVE"  class="form-control" required>
        NO<input type="radio" placeholder="Enter Password" value="no" name="ELECTIVE" id="ELECTIVE"  class="form-control" required>
      </div>
      <input type="submit" value="ADD" class="form-control">
    </div>
    
  </form>  
</div>
<div class="manage_subs" id="manage_subs2" style="Display:none">

        
        <div class="container" align="center" id="fm" class="fm">
          <h4 class="header text-center py-3">EDIT SUBJECTS</h4>
          <ul>
          <label><input type="radio" name="subtype" value="1" onclick="subtypeBlock()">MANDATORY SUBJECTS</label>
	        <label><input type="radio" name="subtype" value="2" onclick="subtypeBlock()">ELECTIVE SUBJECTS</label>
          </ul>
              
          <div class="subtype" id="subtype1" style="Display:none">

                <h4>MANDATORY</h4>
                
                <table>
                  <tr>
                    <th></th>
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT NAME</th>
                    <th>FACULTY</th>
                    <th>CLASS</th>
                    <th colspan="2">MANAGE</th>
                  </tr>
             
                <?php 
                
                  $main_subs = "SELECT subject_details.*, faculty_details.emp_name FROM subject_details INNER JOIN
                                        faculty_details ON subject_details.emp_id = faculty_details.emp_no WHERE subject_details.STATUS = 0";
                  $fetched_main_subs = $conn->query($main_subs);
                  $sr = 1;
                  while($show_main_subs = mysqli_fetch_array($fetched_main_subs, MYSQLI_ASSOC)){
                    $id = $show_main_subs['id'];
                    $sub_name = $show_main_subs['sub_name'];
                    $sub_code = $show_main_subs['sub_code'];
                    $fac_name = $show_main_subs['emp_name'];
                    $class = $show_main_subs['class'];

                  ?>

                      <tr>
                        <td><?php echo $sr; ?></td>
                        <td><input type="text" name="uscode" value="<?php echo strtoupper($sub_code); ?>"></td>
                        <td><input type="text" name="usname" value="<?php echo strtoupper($sub_name); ?>"></td>
                        <td><input type="text" name="ufname" value="<?php echo $fac_name; ?>"></td>
                        <td><input type="text" name="uclass" value="<?php echo $class; ?>"></td>
                        <td><button>UPDATE</button></a></td>
                        <td><a href="?subid=<?php echo $id?>&mnd=1&btn=1"><button onclick="myFunction()">DELETE</button></a></td>
                      </tr>

                  <?php
                    $sr++;  // echo $show_main_subs['sub_name']." ".$show_main_subs['emp_name'].'<br>';
                  }

                ?>
            
          </table>

          </div>
          <div class="subtype" id="subtype2" style="Display:none">
                <h4>ELECTIVES</h4>
                <table>
                  <tr>
                    <th></th>
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT NAME</th>
                    <th>FACULTY</th>
                    <th>CLASS</th>
                    <th colspan="2">MANAGE</th>
                  </tr>
                <?php 
                
                $main_subs = "SELECT elective_details.*, faculty_details.emp_name FROM elective_details INNER JOIN
                faculty_details ON elective_details.emp_id = faculty_details.emp_no WHERE elective_details.STATUS = 0";
                $fetched_main_subs = $conn->query($main_subs);
                $sr = 1;
                while($show_main_subs = mysqli_fetch_array($fetched_main_subs, MYSQLI_ASSOC)){
                  $id = $show_main_subs['id'];
                  $sub_name = $show_main_subs['sub_name'];
                    $sub_code = $show_main_subs['sub_code'];
                    $fac_name = $show_main_subs['emp_name'];
                    $class = $show_main_subs['class'];
                  //echo $show_main_subs['sub_name']." ".$show_main_subs['emp_name'].'<br>';
                  ?>

                  <tr>
                    <td><?php echo $sr; ?></td>
                    <td><input type="text" name="uscode" value="<?php echo strtoupper($sub_code); ?>"></td>
                    <td><input type="text" name="usname" value="<?php echo strtoupper($sub_name); ?>"></td>
                    <td><input type="text" name="ufname" value="<?php echo $fac_name; ?>"></td>
                    <td><input type="text" name="uclass" value="<?php echo $class; ?>"></td>
                    <td><button>UPDATE</button></a></td>
                    <td><a href="?subid=<?php echo $id?>&ele=1&btn=1"><button onclick="myFunction()">DELETE</button></a></td>

                  </tr>

              <?php
                $sr++;  
                }

              ?>
            </table>
          </div>
                
        </div>
        
</div>

<?php

        if(isset($_POST['SUBJECT_CODE'])){
            $sub_code = $_POST['SUBJECT_CODE'];
            $sub_name = $_POST['SUBJECT_NAME'];
            $empid = $_POST['ASSIGN_FACULTY'];

            // $class_deg = $_POST['class_deg'];
            // $class_dip = $_POST['class_dip'];
            if(($_POST['class_deg'] == '1TK' OR $_POST['class_deg'] == '2TK' OR $_POST['class_deg'] == '3TK' OR $_POST['class_deg'] == '4TK' OR
                    $_POST['class_deg'] == '5TK' OR $_POST['class_deg'] == '6TK' OR $_POST['class_deg'] == '7TK' OR 
                            $_POST['class_deg'] == '8TK') AND ($_POST['class_dip'] == '1DK')){
                        
                        $class =  $_POST['class_deg'];
            }
            if(($_POST['class_dip'] == '1DK' OR $_POST['class_dip'] == '2DK' OR $_POST['class_dip'] == '3DK' OR $_POST['class_dip'] == '4DK' OR
                    $_POST['class_dip'] == '5DK' OR $_POST['class_dip'] == '6DK' OR $_POST['class_dip'] == '7DK' OR 
                            $_POST['class_dip'] == '8DK') AND ($_POST['class_deg'] == '1TK')){
                        
                        $class =  $_POST['class_dip'];
            }
            $table_name = "";

            if($_POST['ELECTIVE'] == 'yes'){
                $table_name = "elective_details";
            }
            else{
                $table_name = "subject_details";
            }

            $sql = "INSERT INTO $table_name (sub_code, sub_name, emp_id, class) VALUES ('$sub_code', '$sub_name', '$empid', '$class')";
            

            $query = $conn->query($sql);

            if($query){
                $_SESSION['subject_added'] = 1;
            }
            else{
                $_SESSION['subject_failed_to_add'] = 1;
            }
            // header('location: dashboard.php?btn=1');
        }

        if(isset($_SESSION['subject_added'])){
            ?>
              <span id = 'message'>SUBJECT ADDED</span>
              <script>setTimeout(function() {
                document.getElementById("message").style.display = 'none';
              }, 3000);</script>
          <?php
          unset($_SESSION['subject_added']);
        }

        if(isset($_SESSION['subject_failed_to_add'])){
            ?>
              <span id = 'message'>subject_failed_to_add</span>
              <script>setTimeout(function() {
                document.getElementById("message").style.display = 'none';
              }, 3000);</script>
          <?php
          unset($_SESSION['subject_failed_to_add']);
        }

        if(isset($_GET['subid']) AND isset($_GET['mnd'])){
            $subid = $_GET['subid'];
            $conn->query("UPDATE subject_details SET `STATUS` = 1 WHERE id = '$subid'");

            header('location: dashboard.php?btn=1')
            ?>
              <!-- <script>
                  function myFunction() {
                    location.replace("?btn=1")
                  }
              </script> -->
            <?php
          }
          if(isset($_GET['subid']) AND isset($_GET['ele'])){
            $subid = $_GET['subid'];
            $conn->query("UPDATE elective_details SET `STATUS` = 1 WHERE id = '$subid'");

            ?>
            <script>
                function myFunction() {
                  location.replace("?btn=1")
                }
            </script>
          <?php
          }
}
?>