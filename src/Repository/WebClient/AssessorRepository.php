<?php

namespace AcademyHQ\API\Repository\WebClient;

use AcademyHQ\API\ValueObjects as VO;
use AcademyHQ\API\HTTP\Request\Request as Request;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Common\Credentials;

class AssessorRepository {

	private $base_url = 'https://api.academyhq.com/api/v2/web/client';

	public function __construct(Credentials $credentials)
	{
		$this->credentials = $credentials;
	}

	public function test(VO\Token $token) {

		$request = new Request(
			new GuzzleClient,
			$this->credentials,
			VO\HTTP\Url::fromNative($this->base_url.'/assessor/test'),
			new VO\HTTP\Method('GET')
		);

		$header_parameters = array('Authorization' => $token->__toEncodedString());

		$response = $request->send(null, $header_parameters);

		$data = $response->get_data();

		return $data->message;
	}
}