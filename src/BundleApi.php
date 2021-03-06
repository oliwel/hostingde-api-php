<?php

namespace Hostingde\API;

class BundleApi extends GenericApi {
	protected $location = 'https://secure.hosting.de/api/bundle/v1/json';

	public function bundlesFind($filter, $limit = 50, $page = 1, $sort = NULL) {
		$data = array('authToken' => $this->authToken, 'filter' => $filter, 'limit' => $limit, 'page' => $page, 'sort' => $sort);

		$this->send('bundlesFind', $data);
		if ($this->getStatus() == "error") {
			return false;
		}
		if ($this->getValue()->totalEntries > 0) {
			$return = array();
			foreach($this->getValue()->data as $bundle) {
				$return[] = new Bundle($bundle);
			}
			return $return;
		}
		return array();
	}
}