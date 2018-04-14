 tinymce.init({ selector:'textarea' });
 
    $(document).ready(function(){
       $('#selectAllBoxes').click(function(){
            if(this.checked){
                $('.checkBoxes').each(function(){
                   this.checked = true; 
                });
            }else{
                $('.checkBoxes').each(function(){
                 this.checked = false; 
                });
            } 
        });

    });
    function loadUsers(){
        $.get("functions.php?onlineusers=result",function(data){
            $(".useronline").text(data); 
        });
        
    }
setInterval(function(){
    loadUsers();
},500);

$(document).ready(function(){
         $(".delete_link").on('click',function(){
             var $id= $(this).attr("rel");
             var $delete_url = "posts.php?delete="+$id +" ";
             $(".modal_delete_link").attr("href",$delete_url);
             $("#myModal").modal('show');
         });
     });
    