var lists = new Array();

lists['Select religion']    = new Array();
lists['Select religion'][0] = new Array(
	'This will update after selecting a religion'
);
lists['Select religion'][1] = new Array(
	''
);

// First set of text and values
lists['Paganism']    = new Array();
lists['Paganism'][0] = new Array(
	'Hellenic',
	'Asatru',
	'Roman',
	'Celtic'
);
lists['Paganism'][1] = new Array(
	'Hellenic',
	'Asatru',
	'Roman',
	'Celtic'
);

// Second set of text and values
lists['Wicca']    = new Array();
lists['Wicca'][0] = new Array(
	'Gardnerian',
	'Eclectic',
	'Inclusive',
	'Solitary'
);
lists['Wicca'][1] = new Array(
	'Gardnerian',
	'Eclectic',
	'Inclusive',
	'Solitary'
);

lists['Witchcraft']    = new Array();
lists['Witchcraft'][0] = new Array(
	'British Traditional',
	'Santeria',
	'Voodoo'
);
lists['Witchcraft'][1] = new Array(
	'British Traditional',
	'Santeria',
	'Voodoo'
);

lists['Christianity'] = new Array();
lists['Christianity'][0] = new Array(
	'Catholic',
	'Aglipayan',
	'Protestant',
	'Pentecostal',
	'Baptist',
	'Methodist',
	'Iglesia Ni Cristo',
	'Latter-Day Saints (Mormons)',
	'Seventh-Day Adventist',
	// string escape method here
	'Jehovah\'s Witnesses'
	);
lists['Christianity'][1] = new Array(
	'Catholic',
	'Aglipayan',
	'Protestant',
	'Pentecostal',
	'Baptist',
	'Methodist',
	'Iglesia Ni Cristo',
	'Latter-Day Saints (Mormons)',
	'Seventh-Day Adventist',
	// string escape method here
	'Jehovah\'s Witnesses'
	);
	
lists['Other']    = new Array();
lists['Other'][0] = new Array(
	'Judaism',
	'Sikhism',
	'Shintoism'
);
lists['Other'][1] = new Array(
	'Judaism',
	'Sikhism',
	'Shintoism'
);

lists['No religion']    = new Array();
lists['No religion'][0] = new Array(
	'Atheist',
	'Agnostic'
);
lists['No religion'][1] = new Array(
	'Atheist',
	'Agnostic'
);

// This function goes through the options for the given
// drop down box and removes them in preparation for
// a new set of values

function emptyList( box ) {
	// Set each option to null thus removing it
	while ( box.options.length ) box.options[0] = null;
}

// This function assigns new drop down options to the given
// drop down box from the list of lists specified

function fillList( box, arr ) {
	// arr[0] holds the display text
	// arr[1] are the values

	for ( i = 0; i < arr[0].length; i++ ) {

		// Create a new drop down option with the
		// display text and value from arr

		option = new Option( arr[0][i], arr[1][i] );

		// Add to the end of the existing options

		box.options[box.length] = option;
	}

	// Preselect option 0

	box.selectedIndex=0;
}

// This function performs a drop down list option change by first
// emptying the existing option list and then assigning a new set

function changeList( box ) {
	// Isolate the appropriate list by using the value
	// of the currently selected option

	list = lists[box.options[box.selectedIndex].value];

	// Next empty the slave list

	emptyList( box.form.denomination );

	// Then assign the new list values

	fillList( box.form.denomination, list );
}