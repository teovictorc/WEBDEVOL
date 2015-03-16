/**
 * Filter a column on a specific date range. Note that you will likely need
 * to change the id's on the inputs and the columns in which the start and
 * end date exist.
 *
 *  @name Date range filter
 *  @summary Filter the table based on two dates in different columns
 *  @author _guillimon_
 *
 *  @example
 *    $(document).ready(function() {
 *        var table = $('#example').DataTable();
 *
 *        // Add event listeners to the two range filtering inputs
 *        $('#min').keyup( function() { table.draw(); } );
 *        $('#max').keyup( function() { table.draw(); } );
 *    } );
 */
jQuery(document).ready(function($){
$.fn.dataTableExt.afnFiltering.push(
	function( oSettings, aData, iDataIndex ) {
		var iFini = document.getElementById('dateFilterInicial').value;
		var iFfin = document.getElementById('dateFilterFinal').value;
		var iStartDateCol = 6;
		var iEndDateCol = 6;

		iFini= iFini.substring(0,2) + iFini.substring(3,5) + iFini.substring(6,10);
		iFfin= iFfin.substring(0,2) + iFfin.substring(3,5)+ iFini.substring(6,10);

		var datofini=aData[iStartDateCol].substring(0,2) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(6,10);
		var datoffin=aData[iEndDateCol].substring(0,2) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(6,10);
		console.log(datofini);

		if ( iFini === "" && iFfin === "" )
		{
			return true;
		}
		else if ( iFini <= datofini && iFfin === "")
		{
			return true;
		}
		else if ( iFfin >= datoffin && iFini === "")
		{
			return true;
		}
		else if (iFini <= datofini && iFfin >= datoffin)
		{
			return true;
		}
		return false;
	}
);
});
