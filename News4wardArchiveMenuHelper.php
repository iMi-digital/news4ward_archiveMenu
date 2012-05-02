<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * News4ward
 * a contentelement driven news/blog-system
 *
 * @author Christoph Wiechert <wio@psitrax.de>
 * @copyright 4ward.media GbR <http://www.4wardmedia.de>
 * @package news4ward_archiveMenu
 * @filesource
 * @licence LGPL
 */

class News4wardArchiveMenuHelper extends System
{

	/**
	 * Return the WHERE-condition if a the url has an archive-parameter
	 * @return bool|string
	 */
	public function archiveFilter()
	{
		if(!$this->Input->get('archive')) return;

		if(preg_match("~^\d{4}$~",$this->Input->get('archive')))
		{
			// filter for year
			$year = mysql_real_escape_string($this->Input->get('archive'));
			return 'YEAR(FROM_UNIXTIME(start)) = "'.$year.'"';
		}
		elseif(preg_match("~^\d{4}-\d{1,2}$~",$this->Input->get('archive')))
		{
			// filter for year and month
			list($year,$month) = explode('-',$this->Input->get('archive'));
			$year = mysql_real_escape_string($year);
			$month = mysql_real_escape_string($month);
			return 'YEAR(FROM_UNIXTIME(start)) = "'.$year.'" AND MONTH(FROM_UNIXTIME(start)) = "'.$month.'"';
		}

		return;
	}
}

?>