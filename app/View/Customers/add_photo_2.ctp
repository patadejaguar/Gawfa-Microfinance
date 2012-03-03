
<div id="actionbuttons">
    <div class="browse browsesignature">
        Add/Change Signature
    </div>
    <div class="browse browsephoto">
        Add/Change Photo
    </div>
</div>
<div class="customers form">
    <?php // echo $this->Form->create('Customer', array('type' => 'file')); ?>
    <div class="floatleft width100">
        <div class="floatleft noclear">

            <div class="photo picture">
                <?php
                if (isset($images['photo'])) {
                    echo $this->Html->image($images['photo']);
                }
                ?>
            </div>

            <!--<button>Add/Update Photo</button>-->
        </div>
        <div class="floatleft noclear">
            <div class="signature picture">
                <?php
                if (isset($images['signature'])) {
                    echo $this->Html->image($images['signature']);
                }
                ?>
            </div>

            <!--<button>Add/Update Signature</button>-->
        </div>
        <div class="floatleft noclear">
            <?php // echo $this->Form->file('photo', array('label' => false)); ?><br />
            <?php // echo $this->Form->file('signature', array('label' => false)); ?>

            <?php echo $this->Form->end(__('Add/Update')); ?>


        </div>

    </div>



</div>

<script type="text/javascript">
    
    $(function() {
        // $('.browse').button();
        var myUpload = $('.browsephoto').upload({
            name: 'file',
            action: '/',
            enctype: 'multipart/form-data'
        });
        
        myUpload.onSelect = function() {
            alert("her");
            alert(myUpload.filename());
        }
        
        var myUpload2 = $('.browsesignature').upload({
            name: 'file',
            action: '/',
            enctype: 'multipart/form-data'
        });

								
       
        var options = { 
            target:     '#tabs .customers', 
            // url:        'comment.php', 
            success:    function() { 
                // alert('Thanks for your comment!'); 
            } 
        }; 
        // pass options to ajaxForm 
        // $("#CustomerAddPhotoForm").ajaxForm(options);
        

				
								
    });
</script>