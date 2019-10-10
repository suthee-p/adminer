<?php
/** Display Unique Identifier column type
* @link https://www.adminer.org/plugins/#use
* @author Tom Suthee
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class AdminerUniqueIdentifier {
	private static function bswap(&$arr, $i1, $i2)
	{
		$tmp = $arr[$i1];
		$arr[$i1] = $arr[$i2];
		$arr[$i2] = $tmp;
	}

	private static function uniqueVal($data)
	{
		self::bswap($data, 0, 3);
		self::bswap($data, 1, 2);
		self::bswap($data, 4, 5);
		self::bswap($data, 6, 7);
		return strtoupper(vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
	}

	function selectVal($val, $link, $field, $original) {
		if ($field['type'] === 'uniqueidentifier') {
			return self::uniqueVal($original);
		}
	}

	function editVal($val, $field) {
		if ($field['type'] === 'uniqueidentifier') {
			return self::uniqueVal($val);
		}
	}	
}
