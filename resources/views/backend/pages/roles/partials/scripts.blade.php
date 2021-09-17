<script>
   $('#checkPermissionAll').click(function(){
        if($(this).is(':checked')){
            //check all the checkbox
            $('input[type=checkbox]').prop('checked',true);
        }else{
            // uncheck all the checkbox
            $('input[type=checkbox]').prop('checked',false);
        }
   });

   function checkPermissionByGroup(className, checkThis){
        const groupIdName = $('#'+ checkThis.id);
        const classCheckBox = $('.'+className+' input');

        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked',true);
        }else{
            classCheckBox.prop('checked',false);
        }
        inplementAllChecked();
   }

   function checkSinglePermission(groupClassName, groupID, countTotalPermission){
       const classCheckbox = $('.'+groupClassName+ ' input');
       const groupIDCheckBox = $("#"+groupID);

       //if there is any occurance where something is not selected then make selected = false
       if($('.'+ groupClassName+' input:checked').length == countTotalPermission){
        groupIDCheckBox.prop('checked', true);
       }else{
        groupIDCheckBox.prop('checked', false);  
       }
       inplementAllChecked();
   }

   function inplementAllChecked(){
       const countPermissions = {{ count($all_permissions) }};
       const countPermissoinGroups = {{ count($permission_groups) }};

       if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissoinGroups)){
           $("#checkPermissionAll").prop('checked', true);
       }else{
        $("#checkPermissionAll").prop('checked', false);
       }
   }
</script>