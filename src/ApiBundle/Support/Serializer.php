<?php
namespace ApiBundle\Support;
use ImmediateSolutions\SupportBundle\Api\AbstractSerializer;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
abstract class Serializer extends AbstractSerializer
{
	protected function url($uri)
	{
		return '//'.$uri;
	}
}