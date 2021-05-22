<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $("document").ready(function(){
        $('select[name="category_id"]').on('change',function(){
            //var catId = $(this).val();
            var category = $(this).val();
            //if(catId){
            if(category){
                $.ajax({
                    //url:'/subcategories/'+catId,
                    url:'/subcategories/'+category,
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="subcategory_id"]').empty();
                        $.each(data,function(key,value){
                            $('select[name="subcategory_id"]').append('<option value=" '+key+'">'+value+'</option>');
                        })
                    }
                })
            }else{
              $('select[name="subcategory_id"]').empty();  
            }
        });
    });
</script>