
<div id="message1">


<?php echo $this->Form->create('Type',array('id'=>'form_type','type'=>'file','class'=>'','method'=>'POST','autocomplete'=>'off','inputDefaults'=>array(
                'label'=>false,'div'=>false,'type'=>'text','required'=>false),
                'url' => array('controller' => 'Format', 'action' => 'save')))?>
	
<?php echo __("Hi, please choose a type below:")?>
<br><br>

<?php $options_new = array('Type1', 'Type2');?>

<?php echo $this->Form->input('type', array('legend'=>false, 'type' => 'radio','value'=>'0', 'options'=>$options_new,'before'=>'<label class="radio line notcheck" data-toggle="tooltip" title="
        <strong>Type 1</strong>
        <ul>
            <li>Description...</li>
            <li>Description 2</li>
        </ul>" data-html="true">','after'=>'</label>' ,'separator'=>'</label><label class="radio line notcheck" data-toggle="tooltip" title="
        <strong>Type 2</strong>
        <ul>
            <li>Desc 1...</li>
            <li>Desc 2...</li>
        </ul>" data-html="true">'));?>


<?php echo $this->Form->end('Save');?>

</div>

<style>


.tooltip { 
    left: 90px !important;
}

.tooltip > .tooltip-inner {
  background-color: white; 
  color: black; 
}

#message1 .radio{
	vertical-align: top;
	font-size: 13px;
}

.control-label{
	font-weight: bold;
}

.wrap {
	white-space: pre-wrap;
}

</style>

<?php $this->start('script_own')?>
<script>

$(document).ready(function(){
    // Toggle
    $('[data-toggle="tooltip"]').tooltip({ 
        placement: "right",
        container: '#form_type',
        
    });   
})


</script>
<?php $this->end()?>