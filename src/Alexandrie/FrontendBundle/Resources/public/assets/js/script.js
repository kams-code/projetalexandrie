$(function(){
				
	/*var $chromeTabsExampleShell = $('.chrome-tabs-shell')
	chromeTabs.init({
	  $shell: $chromeTabsExampleShell,
	  minWidth: 45,
	  maxWidth: 160
	});*/
	
	
  $('#annuaire-block').BootSideMenu({
	side: "left",
	pushBody: false,
	// close on click
	closeOnClick: true,
	
	// restore last menu status on page refresh
	remember: true,

	// width
	width: "20%",

	// icons
	icons:{
		left:'fa fa-arrow-left',
		right:'fa fa-arrow-right',
		down:'fa fa-arrow-down'
	},

	// 'dracula', 'darkblue', 'zenburn', 'pinklady', 'somebook'
	theme: '',

  });
  
  
  $('#blog-block').BootSideMenu({
	side: "right",
	pushBody: false,
	
	// close on click
	closeOnClick: true,
	
	// restore last menu status on page refresh
	remember: true,
	// width
	width: "20%",

	// icons
	icons:{
		left:'fa fa-arrow-left',
		right:'fa fa-arrow-right',
		down:'fa fa-arrow-down'
	},

	// 'dracula', 'darkblue', 'zenburn', 'pinklady', 'somebook'
	theme: 'pinklady',
	
  });
  
  //$('#annuaire-block').BootSideMenu().open();
  //$('#blog-block').BootSideMenu().open();

	
	
});
