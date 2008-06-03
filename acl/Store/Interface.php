<?php

interface  StoreInterface
{

	public function addEntry($entry, $parent, $entryType);
	public function deleteAllEntries($entryType);

}

?>