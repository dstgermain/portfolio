// Author: Daniel St. Germain
// Date: April 28, 2014
// Description: Keep for future knowledge - isn't used in the site

function createHeightObject(column){
	"use strict";
	var i = 0,
		columns = {};

	column.each(function(){
		var	id = "#" + $(this).attr("id"),
			heightCol = $(id).height();

		columns[i] = {colId:id,colHeight:heightCol};
		i++;
	});

	console.log(columns);
	return columns;
}

function findSmallest(columns) {
	"use strict";
	var min = Math.min(columns[0].colHeight, columns[1].colHeight, columns[2].colHeight);

	console.log(min);
	return min;
}

function setColumnHeights(columns, min) {
	"use strict";
	for(var col in columns) {
		if (!$.isEmptyObject(columns)) {
			if (columns[col].colHeight > min) {
				var id = columns[col].colId + " .box",
					diff = columns[col].colHeight - min;

				console.log(diff);
				resizeColumns(id, diff);
			}
		}
	}
}

function resizeColumns(id, diff) {
	"use strict";

	var box = {},
		i = 0,
		selector = ":last-of-type";

	$(id).each(function(){
		var	Height = $(this).height();
		box[i] = {boxHeight:Height};
		i++;
	});

	if(box[0].boxHeight > box[1].boxHeight) {
		selector = ":first-of-type";
	}

	id += selector + " .box-description";
	console.log(id);
	$(id).css({height: diff, overflow: "hidden"});
}

$(document).ready(function(){
	"use strict";
	var $col = $(".column");
	

	if ($col.length > 2) {
		var cols = createHeightObject($col),
			min = findSmallest(cols);
		console.log(cols);
		setColumnHeights(cols, min);
	}
});
