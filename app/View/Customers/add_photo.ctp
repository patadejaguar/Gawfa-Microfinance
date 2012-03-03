<div class="customers form">
    <div class="width100">
        <div class="browse browsephoto">
            Add/Change Photo
        </div>
        <div class="noclear">

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
            <?php //    echo $this->Form->file('photo', array('label' => false)); ?><br />
            <?php // echo $this->Form->file('signature', array('label' => false)); ?>

            <?php // echo $this->Form->end(__('Add/Update')); ?>


        </div>

    </div>

</div>

<script type="text/javascript">
    var options = { 
        target:        '.picture',   // target element(s) to be updated with server response 
        // beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse,  // post-submit callback 
 
        // other available options: 
        // url:       '/'  ,      // override for form's 'action' attribute 
        type:      'post'        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
    
    function showResponse(responseText, statusText, xhr, $form)  { 

        alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
            '\n\nThe output div should have already been updated with the responseText.'); 
    } 
    
    $(function() {
        // $('.browse').button();
        var myUpload = $('.browsephoto').upload({
            name: 'file',
           action: '/gawfa/customers/add_photo/customer_id:2/',
            enctype: 'multipart/form-data',
            params: {},
           autoSubmit: false,
            onSubmit: function() {
               // $(this).ajaxSubmit(); 
            },
            onComplete: function(response) {
                alert(response)
            },
            onSelect: function() {
              
            }
        });
        
        
        
       $(".picture").click(function() {
           alert(myUpload.filename());
           myUpload.submit();
       });
        		
								
    });
</script>