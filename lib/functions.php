<?php
// Function File
require_once $_SERVER["DOCUMENT_ROOT"] . "/RequestApp/config/db_config.php";

//############## Version Number ################################################
class ApplicationVersion {
	// Define version numbering
	const MAJOR = 0;
	const MINOR = 0;
	const PATCH = 1;

	public static function get() {
		// Prepare git information to form version number.
		$commitHash = trim(exec('git log --pretty="%h" -n1 HEAD'));

		// Get date and time information.
		$commitDate = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
		$commitDate->setTimezone(new \DateTimeZone('UTC'));

		// Format all information into a version identifier.
		return sprintf('v%s.%s.%s-dev.%s (%s)', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y-m-d H:m:s'));
	}

	// Usage: echo 'MyApplication ' . ApplicationVersion::get();
}

//############## Count Things ##################################################
function countThings($link, $value, $showItemsActive) {
  // Count Types
	if ($showItemsActive == 0) {
		$query = "SELECT COUNT(*) FROM items
		INNER JOIN types ON items.item_type=types.type_id
		WHERE types.type_name = '$value'";
	}

	if ($showItemsActive == 1) {
		$query = "SELECT COUNT(*) FROM items
		INNER JOIN types ON items.item_type=types.type_id
		WHERE types.type_name = '$value' AND items.item_active = '1'";
	}

  $result = mysqli_query($link, $query);
  $rows = mysqli_fetch_row($result);

  // Return Value.
  return $rows[0];
}

//############## Count Totals ##################################################
function countPriceTotals($link, $sessionID) {
	// SQL
	$activesql = "SELECT SUM(item_price) FROM transaction_log
	INNER JOIN items ON transaction_log.trans_item_id=items.item_id
	WHERE trans_session_id = '$sessionID'";

	// Run Query.
	$result = mysqli_query($link, $activesql);
	$row = mysqli_fetch_array($result);

	// Return counted total.
	return $row[0];
}

//############## Calculate VAT #################################################
function calVAT($priceTotal, $VAT) {
	// Check that the VAT value is something we care about.
	if ($VAT != '') {
		if ($VAT < 0.00) {
			$VAT = 0.20;
		}
	} else {
		$VAT = 0.20;
	}

	// Generate VAT Price
	$vatPrice = $priceTotal * $VAT;

	// Return Price
	return $vatPrice;
}

//############## Show Session Running ##########################################
function checkRunningSession($locationID, $link) {
	// Count Types
	$query = "SELECT * FROM sessions
	WHERE session_location_id='$locationID' AND session_closed = 0";

	// Run Query.
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);

	// Return Value.
	if ($locationID == $row['session_location_id']) {
		return "- Running";
	}
}

//############## Is The Session Set ############################################
function isSessionSet($not, $location) {
	// Is either is or not.
	if ($not == 'is' || $not == 'not') {
		// Is
		if ($not == 'is') {
			if (isset($_SESSION['session'])) {
				header('location:' . $environment . $location);
			}
		}
		// Not
		if ($not == 'not') {
			if (!isset($_SESSION['session'])) {
				header('location:' . $environment . $location);
			}
		}
	}
}

//############## Is Session Active Requests ####################################
function isSessionsActive($link, $sessionID) {
	$query = "SELECT * FROM sessions
	WHERE session_id='$sessionID' AND session_closed = 0";

	// Run Query.
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);
	$sessionNumber = $row['session_id'];
	$sessionEnd = $row['session_end'];

	if ($sessionID == $sessionNumber) {
		return "<td class='text-center'>{$sessionID}</td>";
	} else {
		return "<td class='text-center' style='color: red;' title='{$sessionEnd}'>{$sessionID}</td>";
	}
}
?>
