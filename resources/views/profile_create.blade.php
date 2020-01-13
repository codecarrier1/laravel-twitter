@extends('layouts.app')

@section('content')
<div class="con1tainer row">
    
        <div class="col-lg-5" style="text-align: center;">
         </div>  
        <div  class="col-lg-2  justify-content-center form-control" class="" style="height:600px; padding:20px">
            <h3 class="text-center">Create New Profile</h3>
            <?php
            if($profile == null){
            ?>
            <form action='/profile/create' method="post" >
            <?php }
            else
            {
            ?><form action='/profile/update' method="post" >
            <?php }?>
                <table>
                    <?   if($profile ==null){
                    ?>
                     <tr><td style="height:10px">&nbsp;</td></tr>
                    <tr style="padding:20px;">
                        <td style="margin-top:20px">Country:</td>
                        <td><select name="country" id="country"></select></td>
                    </tr><tr><td style="height:10px">&nbsp;</td></tr>
                    <tr>
                        <td>Keyword1:</td>
                        <td><textarea type="text" rows="6" id="keyword1" name="keyword1"></textarea></td>
                    </tr><tr><td style="height:10px">&nbsp;</td></tr>
                    <tr>
                        <td>Keyword2:</td>
                        <td><textarea type="text" rows="4" id="keyword2" name="keyword2"></textarea></td>
                    </tr><tr><td style="height:10px">&nbsp;</td></tr>
                    <tr>
                        <td>Priority:</td>
                        <td>
                            <input type="radio" name="spammer" style="margin-left:30px;" value="priority1" checked="true"> Priority1<br>
                            <input type="radio" style="margin-left:30px;" name="spammer"  value="priority2"> Priority2<br>
                        </td>
                    </tr>
                      </table>
            <div class="text-center" style="margin-top:20px"><button type="submit" id="create"><span>Create new profile</span></button> </div>
                      <? }
                      else{
                    ?>
                    <tr><input type="hidden" id="id" value="<?php echo $profile->id;?>" name="id"><td style="height:10px">&nbsp;</td></tr>
                    <tr style="padding:20px;">
                        <td style="margin-top:20px">Country:</td>
                        <td><select name="country" value="<?php echo $profile->country;?>"  id="country"></select><input type="hidden" value="<?php echo $profile->country?>" id="t_country"></td>
                    </tr><tr><td style="height:10px">&nbsp;</td></tr>
                    <tr>
                        <td>Keyword1:</td>
                        <td><textarea type="text" rows="6" id="keyword1" name="keyword1"> <?php echo $profile->keyword1;?> </textarea></td>
                    </tr><tr><td style="height:10px">&nbsp;</td></tr>
                    <tr>
                        <td>Keyword2:</td>
                        <td><textarea type="text" rows="4" id="keyword2" name="keyword2"> <?php echo $profile->keyword2;?></textarea></td>
                    </tr><tr><td style="height:10px">&nbsp;</td></tr>
                    <tr>
                        <td>Priority:</td>
                        <td>
                            <?php
                            $check1="";
                            $check2="";
                                if($profile->priority==1)
                                    $check1 = "checked=true";
                                else
                                    $check2 = "checked=true";
                            ?>
                            <input type="radio" name="spammer" style="margin-left:30px;" value="priority1" <?php echo $check1;?> > Priority1<br>
                            <input type="radio" style="margin-left:30px;" name="spammer"  value="priority2" <?php echo $check2;?> > Priority2<br>
                        </td>
                    </tr>
                    
                     </table>
            <div class="text-center" style="margin-top:20px"><button type="submit" id="create"><span>Update new profile</span></button> </div>
                    <?php }?>
               
              
        </form>
        </div>
       <div class="col-lg-5"></div> 
                
                
          
    </div>
       
    <script>
     $(document).ready(function(){
       $.getJSON("/public/codebeautify.json", function(result){
                console.log(result);
                var country = $("#country").val();
                var temp;
                var html="";
                data = result;
                var t_country = $("#t_country").val();
                
                for(var i = 1 ;i < result.length; i ++)
                {
                    
                    if(temp != result[i]["country"])
                    {
                        var check = "";
                        if(t_country == result[i]["country"])
                            check = " selected "
                        html +="<option"+check+" value='"+result[i]["country"]+"'>";
                        html +=  result[i]["country"];
                        html +="</option>";
                        temp = result[i]["country"];
                    }
                }
                $("#country").html(html);

        });
    });
     
</script>
<style type="text/css">
    .invisible{
        display: none;
        height: 0px;
    }
    td{
        text-align: center;

    }
</style>
</div>
@endsection
