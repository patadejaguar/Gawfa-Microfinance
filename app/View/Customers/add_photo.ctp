<div class="customers form">
    <?php echo $this->Form->create('Customer', array('type' => 'file')); ?>
    <div class="floatleft width100">
        <div class="floatleft noclear">
            <div class="photo picture">
                <?php
                    if(isset($images['photo'])) {
                        echo $this->Html->image($images['photo']);
                    }
                ?>
            </div>


            <!--<button>Add/Update Photo</button>-->
        </div>
        <div class="floatleft noclear">
            <div class="signature picture">
                <?php
                    if(isset($images['signature'])) {
                        echo $this->Html->image($images['signature']);
                    }
                ?>
            </div>

            <!--<button>Add/Update Signature</button>-->
        </div>
        <div class="floatleft noclear">
            <?php echo $this->Form->file('photo', array('label' => false)); ?><br />
            <?php echo $this->Form->file('signature', array('label' => false)); ?>
            <?php echo $this->Form->end(__('Add/Update')); ?>
        </div>

    </div>
</form>

</div>

<script type="text/javascript">
    
    $(function() {

								
        $('button').button().file().choose(function(e, input) {
            // alert("you choose: " + input.val());
            
        });
        

        var options = { 
            target:     '#tabs .customers', 
            // url:        'comment.php', 
            success:    function() { 
                // alert('Thanks for your comment!'); 
            } 
        }; 
        // pass options to ajaxForm 
        $("#CustomerAddPhotoForm").ajaxForm(options);
        

				
								
    });
</script>