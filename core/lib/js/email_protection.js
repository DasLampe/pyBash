$(document).ready(function () {

	$('a').each(function() {
		var href, mailaddress;
		href = $(this).attr('href');
		if(href && href.search(/mailto:/) != -1)
		{
			mailaddress = href.substr(6);
			mailaddress	= Base64.decode(mailaddress);
			$(this).attr('href', 'mailto:'+mailaddress);
			
			if($(this).html().search(/ät|at/) != -1)
			{
				$(this).html(mailaddress);
			}
		}
	});
});