<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid'] == 0)) {
	header('location:logout.php');
} else {

	//code deletion
	if (isset($_GET['delid'])) {
		$rowid = intval($_GET['delid']);
		// echo($rowid);
		$query = mysqli_query($con, "delete from tblexpense where ID='$rowid'");
		if ($query) {
			echo "<script>alert('Ghi nhận xoá thành công');</script>";
			echo "<script>window.location.href='manage-expense.php'</script>";
		} else {
			echo "<script>alert('Đã sai điều gì đó, vui lòng nhập lại!');</script>";

		}

	}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quản lý chi tiêu cá nhân || Quản lý chi phí</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">



	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400&display=swap"
		rel="stylesheet">
</head>

<body>
	<?php include_once('includes/header.php'); ?>
	<?php include_once('includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-home"></em>
					</a></li>
				<li class="active">Chi phí</li>
			</ol>
		</div>
		<!--/.row-->




		<div class="row">
			<div class="col-lg-12">



				<div class="panel panel-default">
					<div class="panel-heading">Chi phí</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center">
							<?php if ($msg) {
		echo $msg;
	} ?>
						</p>
						<div class="col-md-12">

							<div class="table-responsive">
								<table class="table table-bordered mg-b-0">
									<thead>
										<tr>
											<th>Thứ tự</th>
											<th>Danh mục</th>
											<th>Tiền chi</th>
											<th>Ngày chi</th>
											<th></th>
										</tr>
									</thead>
									<?php
	$userid = $_SESSION['detsuid'];
	$ret = mysqli_query($con, "select * from tblexpense where UserId='$userid'");
	$cnt = 1;
	while ($row = mysqli_fetch_array($ret)) {

                                    ?>
									<tbody>
										<tr>
											<td>
												<?php echo $cnt; ?>
											</td>

											<td class="nameItem">
												<?php echo $row['ExpenseItem']; ?>
											</td>
											<td>
												<?php echo $row['ExpenseCost']; ?>
											</td>
											<td>
												<?php echo $row['ExpenseDate']; ?>
											</td>
											<td><a href="manage-expense.php?delid=<?php echo $row['ID']; ?>">Xoá</a>
										</tr>
										<?php
		$cnt = $cnt + 1;
	} ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php'); ?>
		</div><!-- /.row -->
	</div>
	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>

</body>

</html>
<?php } ?>