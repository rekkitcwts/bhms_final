
			
$(document).ready(function()
{
	$.toast.config.align = 'right';
	$.toast.config.width = 400;
	
	function createToast(t)
{
	var message = 'Hi, I\m just your every day, average kind of toast.';
	var options = {
		duration: Math.floor(Math.random() * 4001) + 1000,
		sticky: !!Math.round(Math.random() * 1),
		type: t
		};
				
	switch(t)
	{
		case 'danger': message = '<h4>Danger!</h4> Oh no. You\'ve activated a dangerous toast. Beware as it was may (or may not) be sticky.'; break;
		case 'info': message = '<h4>FYI</h4> I\'m a toast and I just wanted you to know that.'; break;
		case 'success': message = '<h4>Great!</h4> You\'ve made a toast. Now let\'s\ toast to you.'; break;
		case 'blankfield': message = '<h4>Blank field alert</h4> This field must not be blank!.'; break;
	}

		$.toast(message, options);
}
				
	$('toast').click(function()
	{
		createToast($(this).attr('class'));
		return false;
	});
	
	$('#ornumber').keyup(function()
	{
		if($(this).val().length == 0)
		{
		createToast('danger');
		return false;
		}
	});
});