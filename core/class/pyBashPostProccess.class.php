<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pyBashPostProccess
{	
    public static function protectEmail($html)
    {
    	$regexp = '/
    				( # leading text
       					<\w+.?>| # leading HTML tag, or
    					[^=:!\'"\/]| # leading punctuation, or
    					<a.?href="mailto:|
    					^ # beginning of line
    				)
					(
						[a-z]+[a-z0-9\-\.\_]+?@[a-z0-9\-\.]+[a-z]{2,6}
					)
    				(
    					[[:punct:]]||\s|<|$
    				) # trailing text
    			/x';
    	
    	return preg_replace_callback($regexp, function($matched) {
    		list($all, $before, $address, $after) = $matched;
    	
    		// already linked
    		if (preg_match('/<a\s/i', $before)) {
    			return preg_replace_callback("/[a-z]+[a-z0-9\-\.\_]+?@[a-z0-9\-\.]+[a-z]{2,6}/x", function($matches){return base64_encode($matches[0]);}, $all);
    		}
    	
    		$text 		= strtr($address,array("@"=> " ät ", "." => " dot "));
    		$address	= base64_encode($address); 
    	
    		return $before.'<a href="mailto:'.$address.'">'.$text.'</a>'.$after;
    	}, $html);
    }
    
    /**
     * See https://gist.github.com/907604
     * @param string $html
     */
    public static function make_links_clickable($html)
    {
		$regexp = '/
			( # leading text
			<\w+.*?>| # leading HTML tag, or
			[^=!:\'"\/]| # leading punctuation, or
			^ # beginning of line
			)
			(
			(?:https?:\/\/)| # protocol spec, or
			(?:www\.) # www.*
			)
			(
			[-\w]+ # subdomain or domain
			(?:\.[-\w]+)* # remaining subdomains or domain
			(?::\d+)? # port
			(?:\/(?:(?:[~\w\+%-]|(?:[,.;:][^\s$]))+)?)* # path
			(?:\?[\w\+%&=.;-]+)? # query string
			(?:\#[\w\-]*)? # trailing anchor
			)
			([[:punct:]]|\s|<|$) # trailing text
		/x';
		
		return preg_replace_callback($regexp, function($matched) {
		list($all, $before, $protocol, $address, $after) = $matched;
		
		// already linked
		if (preg_match('/<a\s/i', $before)) {
			return $all;
		}
		
		$text = $protocol . $address;
		$protocol = $protocol == 'www.' ? 'http://www.' : $protocol;
		
		return "$before<a href=\"$protocol$address\">$text</a>$after";
		}, $html);
    }
}