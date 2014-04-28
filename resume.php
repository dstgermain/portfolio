<?php 
require_once('dbconnection.php');
$query_entries = "SELECT employer_name, employer_location, date_start, date_end, job_title, job_description, job_list  FROM resume_entries ORDER BY exp_ID";
$items = mysqli_query($conn, $query_entries) or die(mysqli_error());
$row_entries = mysqli_fetch_assoc($items); 
$totalRows_entries = mysqli_num_rows($items);

$query_schools = "SELECT school, grad_date, grad_degree, school_additional FROM resume_education ORDER BY edu_ID DESC";
$schools = mysqli_query($conn, $query_schools) or die(mysqli_error());
$row_schools = mysqli_fetch_assoc($schools); 
$totalRows_schools = mysqli_num_rows($schools);

$query_program = "SELECT skill_name, skill_knowledge FROM resume_skills WHERE skill_category='program'";
$programs = mysqli_query($conn, $query_program) or die(mysqli_error());
$row_programs = mysqli_fetch_assoc($programs); 
$totalRows_programs = mysqli_num_rows($programs);

$query_script = "SELECT skill_name, skill_knowledge FROM resume_skills WHERE skill_category='script'";
$scripts = mysqli_query($conn, $query_script) or die(mysqli_error());
$row_scripts = mysqli_fetch_assoc($scripts); 
$totalRows_scripts = mysqli_num_rows($scripts);

$page = 'resume';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<div id="main-content" role="main">
	<div class="wrapper resume">
		<div class="column-double left">
		<h2>Experience</h2>
		<?php do { ?>
			<div class="resume-entry">
				<div class="resume-date">
					<div class="date">
						<?php echo "<span class='first'>" . $row_entries['date_start'] . "</span>"; ?>
						<?php if ($row_entries['date_start']!==$row_entries['date_end']) echo "<span class='last'>" . $row_entries['date_end'] . "</span>"; ?>
					</div>
				</div>
				<div class="resume-description">
					<h3><?php echo $row_entries['employer_name']; ?><small><?php if($row_entries['employer_location']!=="null") echo $row_entries['employer_location']; ?></small></h3>
					<h4><?php echo $row_entries['job_title']; ?></h4>
					<p>
					<?php
						$desc = explode("|",$row_entries['job_description']);
						if ($desc[0] !== "null") {
							echo $desc[0];
						}
						echo "<a href=\"" . $desc[1] . "\">" . $desc[1] . "</a>";
					?>
					</p>
					<?php 
						$list = explode(";", $row_entries['job_list']);
						$ul = "<ul class=\"desc-list\">";
						foreach ($list as $item) {
							$ul .= "<li>$item</li>";
						} 
						$ul .= "</ul>";
						echo $ul;
					?>
				</div>
			</div>
		<?php } while ($row_entries = mysqli_fetch_assoc($items)); ?>
		<h2>Education</h2>
		<?php do { ?>
			<div class="resume-entry left half-width">
			<h3><?php echo $row_schools['school']; ?></h3>
			<h4><?php echo $row_schools['grad_degree']; ?></h4>
			<span class="grad-date"><?php echo $row_schools['grad_date']; ?></span>
			<?php if (isset($row_schools['school_additional'])) { ?>
				<p><?php $row_schools['school_additional']; ?></p>
			<?php } ?>
			</div>
		<?php } while ($row_schools = mysqli_fetch_assoc($schools)); ?>
		</div>
		<div class="column left">
		<h2>Program Knowledge</h2>
		<ul>
		<?php do { ?>
			<li>
			<?php 
				$j=0;
				for($i=1;$i<=$row_programs['skill_knowledge'];$i++){
					echo "<span class='blue'>&circledast;</span>";
					$j++;
				}
				if($j<5){
					for($i=$j;$i<5;$i++){
						echo "<span class='lt-blue'>&circledast;</span>";
					}
				}
				echo $row_programs['skill_name'];
			?>
			</li>
		<?php } while ($row_programs = mysqli_fetch_assoc($programs)); ?>
		<h2>Script Knowledge</h2>
		<ul>
		<?php do { ?>
			<li>
			<?php 
				$j=0;
				for($i=1;$i<=$row_scripts['skill_knowledge'];$i++){
					echo "<span class='blue'>&circledast;</span>";
					$j++;
				}
				if($j<5){
					for($i=$j;$i<5;$i++){
						echo "<span class='lt-blue'>&circledast;</span>";
					}
				}
				echo $row_scripts['skill_name'];
			?>
			</li>
		<?php } while ($row_scripts = mysqli_fetch_assoc($scripts)); ?>
		</ul>
		<a href="#" class="resume-download">Resume Download</a>
		</div>
	</div>
</div>
<?php include 'includes/_footer.php'; ?>