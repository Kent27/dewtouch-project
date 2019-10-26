<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody>
	<tr id="row1">
        <td name><span id="del1" class="btn mini delbutton" onclick="delObj(1)">
        <i class="icon-remove"></i></span></td>
        <td name="data[1][description]" class="" input-text data-type="textarea"><p></p></td>
        <td name="data[1][quantity]" class="" input-text data-type="number"><p></p></td>
        <td name="data[1][unit_price]"  class="" input-text data-type="number"><p></p></td>
    </tr>

</tbody>

</table>
<input type="hidden" id="counter" value=1 />

<p></p>
<div class="alert alert-info ">
<button class="close" data-dismiss="alert"></button>
Video Instruction</div>

<p style="text-align:left;">
<video width="78%"   controls>
  <source src="<?php echo Router::url('/') ?>/video/q3_2.mov">
Your browser does not support the video tag.
</video>
</p>





<?php $this->start('script_own');?>
<script>
$(document).ready(function(){
    // Add Rows
	$("#add_item_button").click(function(){

        var table = $('table > tbody:last-child');
        $('#counter').val(parseInt($('#counter').val())+1);
        var counter = $('#counter').val();

        var row = '<tr id="row'+counter+'"><td name><span id="del'+counter+'" class="btn mini delbutton" onclick="delObj('+counter+')">'+
        '<i class="icon-remove"></i></span></td><td name="data['+counter+'][description]" class="" input-text data-type="textarea"><p></p></td>'+
        '<td name="data['+counter+'][quantity]" class="" input-text data-type="number"><p></p></td>'+
        '<td name="data['+counter+'][unit_price]"  class="" input-text data-type="number"><p></p></td></tr>';
        table.append(row);
		

	});

    $('body').on('click', '[input-text]', function(){
  
        var $el = $(this);

        // Change text into textarea
        var $input = $('<textarea class="m-wrap  description required" rows="2"/>').val( $el.text() );

        if($el.data('type')!='textarea'){ // If not textarea
            $input = $('<input type="'+$el.data('type')+'"/>').val( $el.text() );
        }

        $el.find('p').replaceWith( $input );
        
        // Change it back into text
        var save = function(){
            var $p = $('<p />').text( $input.val() );
            $input.replaceWith( $p );
        };
        
        $input.one('blur', save).focus();
    
    });
	
});

//Delete Rows
function delObj(i){
    $('#row'+i).remove();
}

</script>
<?php $this->end();?>

