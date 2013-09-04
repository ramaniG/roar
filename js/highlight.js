/**************************************************************************
 *                                                                        *
 *  JAVASCRIPT MENU HIGHLIGHTER v.1.5 (080929)                            *
 * --------------------------------------------                           *
 * �2005 Media Division (www.MediaDivision.com)                           *
 *                                                                        *
 * Written by Marius Smarandoiu & Armand Niculescu                        *
 *                                                                        *
 * You are free to use, modify and distribute this file, but please keep  *
 * this header and credits                                                *
 *                                                                        *
 * Usage:                                                                 *
 * - the script will apply the .current class to the <a> and its parent   *
 *   <li> that is contained in the element with id="primarynav" and points*
 *   to the current URL                                                   *
 * - works in IE6, Firefox and Opera                                      *
 **************************************************************************/
function extractPageName(hrefString)
{
	var arr = hrefString.split('/');
	return  (arr.length<2) ? hrefString : arr[arr.length-2].toLowerCase() + arr[arr.length-1].toLowerCase();               
}

function setActiveMenu(arr, crtPage)
{
	for (var i=0; i<arr.length; i++)
	{
		if(extractPageName(arr[i].href) == crtPage)
		{
			arr[i].className = "cuffon active";
			arr[i].parentNode.parentNode.parentNode.parentNode.className = "active";		
		}
	}
}

function setPage()
{
	hrefString = document.location.href ? document.location.href : document.location;

	if (document.getElementById("menu")!=null)
		setActiveMenu(document.getElementById("menu").getElementsByTagName("a"), extractPageName(hrefString));
}

function setAll()
{
	document.getElementById("menu").id ="highlight-all"
}