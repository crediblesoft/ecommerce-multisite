<div class="col-sm-9">
    <div class="row">
                <div class="">
                    <div class="contant-head">
                         <h4> <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Manage Product Bid</h4>
                    </div>
                </div>
            </div>
            
            <div class="contant-body1">
                <div class="col-sm-12">
                    <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered cus-table-bordered">
                            <thead class="cus-thead">
                                <tr>
                                    <td>Date</td>
                                    <td>Product</td>
                                    <td>Price</td>
                                    <td>won</td>
                                    <td>status</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if($bidproduct['res']){ 
                                    $currentdate=date('Y-m-d');
                                    //echo $currentdate;
                                foreach($bidproduct['rows'] as $productlist){
                                    //echo "<pre>";print_r($productlist);
                                    
                                $sql="select * from product_auction where prod_id=$productlist->prodId and status='1'";
                                $query=$this->db->query($sql);
                                $result=$query->result();
                                //echo "<pre>"; print_r($result); 
                                        if($query -> num_rows() > 0)
                                        {
                                            $resp['winner']=array('res'=>true,'rows'=>$query->result());
                                        }
                                        else
                                        {
                                            $resp['winner']=array('res'=>false);
                                        }
                                        //echo "<pre>";
                                        //print_r($resp['winner']);
                                       $auctionid=$resp['winner']['rows'][0]->id;
                                        $sql1="select bid.price,bid.id as bidid,u.id as buyerid,u.username,u.mobile_no,u.email_id,u.f_name,u.l_name,u.address1,rv.review from bid_tbl_cart as bid left join user_Info as u on bid.user_id=u.id left join buyer_review as rv on bid.id=rv.bid_id where bid.auction='".$auctionid."' AND bid.price=(SELECT MAX(price) FROM bid_tbl_cart where auction='".$auctionid."')";
                                        //print $sql;
                                        $query1=$this->db->query($sql1);
                                        
                                        $result1=$query1->result();
                                        //echo "<pre>";
                                        //print_r($result1);exit;
                                                if($query1 -> num_rows() > 0)
                                                {
                                                    $resp['winner1']=array('res'=>true,'rows'=>$query1->result());
                                                }
                                                else
                                                {
                                                    $resp['winner1']=array('res'=>false);
                                                }
                                                $buyer_id=$resp['winner1']['rows'][0]->buyerid;
                                     //echo "<pre>";
                                     //print_r($resp['winner1']);
                                  //echo "<br/>aa".$productlist->bid_end_date;
                                    $bid_declear_date = new DateTime($productlist->bid_end_date);
                                    $bid_declear_date->modify('+1 day');
                                    
                                    
                                    
                            ?>    
                                <tr>
                                    <td><?=$productlist->add_date?></td>
                                    <td><a href="<?=BASE_URL?>bid/porductdetails/<?=$productlist->prodId?>"><?=$productlist->prod_name?></a></td>
                                    
                                    <td>$<?=$productlist->price?></td>
                                    <?php if($currentdate > $productlist->bid_end_date ){ ?>
                                    <td><a href="javascript:void(0)" id="<?=$productlist->prodId?>" class="winner" data-target="#buyerdetails" data-toggle="modal">win</a></td>
                                    <?php }else{ ?>
                                    <td><a href="javascript:void(0)" id="<?=$bid_declear_date->format('Y-m-d')?>" class="winner1" data-target="#buyerdetails" data-toggle="modal">win</a></td>
                                    <?php } ?>
                                    <td>
                                    <?php if($currentdate <$productlist->bid_end_date ){
                                    echo "On Going";}   
                                    elseif($currentdate > $productlist->bid_end_date){
                                        if($buyer_id==$this->session->userdata('user_id')) {
                                        echo "Winner";
                                         }
                                        else{echo "Not Win";}
                                    }
                                    else{
                                       echo "On Going";  
                                    }
                                    ?>
                                    </td>
                                    
                                </tr>
                                <?php }}else{ ?>
                                <tr>
                                    <td colspan="4"> <p class="text-danger">No Record Found</p></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                           <?php echo $links; ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
    
    
            
</div>

</div>
</div>



<!-- Modal -->
<div id="buyerdetails" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Winner Details</h4>
      </div>
        <div class="modal-body">
          <table class="table table-bordered" id="userdata">
              
          </table>
      </div>
      <div class="modal-footer"> 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
    $(document).ready(function(){

        $(".winner1").click(function(){
            var id=$(this).prop('id');
            //alert(id);
            
            $("#userdata").empty().html("<tr><td>Product winner declare on "+id+"</td></tr>");
        });
        
        $(".winner").click(function(){
            var id=$(this).prop('id');
            var tabledata="";
            $.post("<?=BASE_URL?>product/getwinner",{id:id},function(data,status){        
                var obj = jQuery.parseJSON(data);
                //console.log(obj.data[0].price);
                if(obj.res){
                    var user=obj.data[0];
                    tabledata+="<tr>";
                    tabledata+="<td> Username </td>";
                    tabledata+="<td>"+user.username+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Mobile </td>";
                    tabledata+="<td>"+user.mobile_no+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Name </td>";
                    tabledata+="<td>"+user.f_name+" "+user.l_name+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Email </td>";
                    tabledata+="<td>"+user.email_id+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Address </td>";
                    tabledata+="<td>"+user.address1+"</td>";
                    tabledata+="<tr>";
                    
                    tabledata+="<tr>";
                    tabledata+="<td> Price </td>";
                    tabledata+="<td> $"+user.price+"</td>";
                    tabledata+="<tr>";
  
                }else{
                    tabledata+="<tr>";
                    tabledata+="<td> Data Not Found!! </td>";
                    tabledata+="<tr>";
                }
                $("#userdata").html(tabledata);
                
            });
        });
    });
</script> 
