$(document).ready(function() {

		//$("#faq_search_input").watermark("Name Search");

		$("#faq_search_input").keyup(function()
		{
			var faq_search_input = $(this).val();
			var dataString = 'keyword='+ faq_search_input;
			if(faq_search_input.length>0)
			{
				if($("#searchtype :selected").val() == "Last")
				{
					$.ajax({
					type: "GET",
					url: "offlodger-search-payment.php",
					data: dataString,
					beforeSend:  function() 
					{
						$('input#faq_search_input').addClass('loading');
					},
					success: function(server_response)
					{
						$('#searchresultdata').html(server_response).show();
						$('span#faq_category_title').html(faq_search_input);
						
							if ($('input#faq_search_input').hasClass("loading")) {
								$("input#faq_search_input").removeClass("loading");
							} 
					}
					});
				}
				else if($("#searchtype :selected").val() == "First")
				{
					$.ajax({
					type: "GET",
					url: "offlodger-search-payment-firstname.php",
					data: dataString,
					beforeSend:  function() 
					{
						$('input#faq_search_input').addClass('loading');
					},
					success: function(server_response)
					{
						$('#searchresultdata').html(server_response).show();
						$('span#faq_category_title').html(faq_search_input);
						
							if ($('input#faq_search_input').hasClass("loading")) {
								$("input#faq_search_input").removeClass("loading");
							} 
					}
					});
				}
			}
			else
			{
				$.ajax({
					type: "GET",
					url: "offlodger-list-payment.php",
					data: dataString,
					beforeSend:  function() 
					{
						$('input#faq_search_input').addClass('loading');
					},
					success: function(server_response)
					{
						$('#searchresultdata').html(server_response).show();
						$('span#faq_category_title').html(faq_search_input);
						
							if ($('input#faq_search_input').hasClass("loading")) {
								$("input#faq_search_input").removeClass("loading");
							} 
					}
					});
			}
			return false;
		});
	});
	  