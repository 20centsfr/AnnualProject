<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('includes/db.php');
session_start();

if(isset($_POST["rating_data"])) {

	$data = array(
		':entreprise'	=>	$_POST["entreprise"],
		':rating'		=>	$_POST["rating_data"],
		':review'		=>	$_POST["review"],
		':date'			=>	date()
	);

	$q = "INSERT INTO note (entreprise, rating, review, date) VALUES (:entreprise, :rating, :review, :date)";
	$stmt = $db->prepare($q);
	$stmt->execute($data);

	echo "Succès";

}

if(isset($_POST["action"])) {
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_rating = 0;
	$review_content = array();

	$q = "SELECT * FROM note ORDER BY idNote DESC";

	$result = $db->query($q, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'entreprise'		=>	$row["entreprise"],
			'review'	=>	$row["review"],
			'rating'		=>	$row["rating"],
			'date'		=>	date('l jS, F Y h:i:s A', $row["date"])
		);

		if($row["rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_rating = $total_rating + $row["rating"];

	}

	$average_rating = $total_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>