<?php

namespace Hostingde\API;

class BillingApi extends GenericApi {
	protected $location = 'https://secure.hosting.de/api/billing/v1/json';

	public function articlePurchasePricesFind($filter, $limit = 50, $page = 1, $ownerAccountId = NULL, $skipPagination = false) {
		$data = array('authToken' => $this->authToken, 'filter' => $filter, 'limit' => $limit, 'page' => $page, 'ownerAccountId' => $ownerAccountId, 'skipPagination' => $skipPagination);

		$this->send('articlePurchasePricesFind', $data);
		if ($this->getStatus() == "error") {
			return false;
		}

		if ($this->getValue()->totalEntries > 0) {
			$return = array();
			foreach($this->getValue()->data as $articlePurchasePrice) {
				$return[] = new ArticlePurchasePrice($articlePurchasePrice);
			}
			return $return;
		}
		return array();
	}
}