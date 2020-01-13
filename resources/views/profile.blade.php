@extends('layouts.app')

@section('content')
<div class="con1tainer">
    
        <div class="col-lg-12" style="text-align: center;">
            
               
                
                  
                <div class="card-body col-md-12 center"  style="float:left" >
                    <h2>Profile List</h2>
                    <table class="table-bordered table-secondary table-striped text-center" id="tbl_profile" style="width: 100%;"><tr><td style="width:5%">No</td> <td style="width:8%">Country</td><td style="width:8%">Keyword1</td><td style="">Keyword2</td><td style="width:8%"> Priority</td><td style="width:16%">Action</td></tr>
                     <?php $i=0;?>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>{{ ++$i }}  </td>
                                
                                <td >{{ $profile->country }}</td>
                                <td >
                                    
                                    <?php
                                        $temp = explode("\n", $profile->keyword1);
                                        foreach($temp as $key)
                                        {
                                            if($key!="")
                                            echo $key."<br>";
                                        }
                                    ?>
                                </td>
                                <td >{{ $profile->keyword2 }}</td>
                                <td >{{ $profile->priority }}</td>
                                <td><a href="#" onclick="edit_profile(<?php echo $profile->id;?>)">Edit</a>&nbsp;&nbsp;&nbsp;
                                 <a style="color: red" href="#" onclick="remove_profile(<?php echo $profiles[$i-1]->id ?>)">Remove</a> </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
           </div>
    </div>
       <form action="/create/update" method="post" id="form">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <input type="text" name="id" id="id"> 
            
           
       </form>
    <script>
     $(document).ready(function(){
       $.getJSON("/public/codebeautify.json", function(result){
                console.log(result);
                var country = $("#country_u").val();
                var temp;
                var html="";
                data = result;
                for(var i = 1 ;i < result.length; i ++)
                {
                    if(temp != result[i]["country"])
                    {
                        html +="<option value='"+result[i]["country"]+"'>";
                        html +=  result[i]["country"];
                        html +="</option>";
                        temp = result[i]["country"];
                    }
                }
                $("#country_u").html(html);

        });
    });
    function edit_profile(id){
       
       $("#id").val(id);
        $("#form").submit();
      

    }
    function remove_profile(id){
        var r = confirm("Are sure remove this profile?");
        if (r == true) 
        {
            $("#id").val( id);
             
            $("#form").attr("action","/profile/remove");
            $("#form").submit();
        } 
         
        

    }
</script>
<style type="text/css">
    .invisible{
        display: none;
        height: 0px;
    }
    
</style>
</div>
@endsection
