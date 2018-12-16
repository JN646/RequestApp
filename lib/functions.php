<?php
// Function File

//############## Version Number ################################################
class ApplicationVersion
{
	// Define version numbering
	const MAJOR = 0;
	const MINOR = 0;
	const PATCH = 1;

	public static function get()
	{
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

function countThings($link, $value)
{
  // Count Types
  $query = "SELECT COUNT(*) FROM items
  INNER JOIN types ON items.item_type=types.type_id
  WHERE type_name = '$value'";

  $result = mysqli_query($link, $query);
  $rows = mysqli_fetch_row($result);

  // Return Value.
  return $rows[0];
}
?>
