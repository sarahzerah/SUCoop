 <?php
                          $fsql=mysqli_query($con,$fast);
                          $fsqlinv=mysqli_query($con,$fastinv);
                          $array_item=array();

                          $count=0;
                          $same=0;
                          $pick=0;
                          $orArray=array();
                          $ciArray=array();
                
                      //Cash sales
                      if (mysqli_num_rows($fsql) > 0):
                          while($frow=mysqli_fetch_array($fsql)): //from cash_sales
                            $or=$frow['ORNum'];
                            $orArray[$count]=$frow['ORNum'];
                            $sales="SELECT productNum FROM items WHERE ORNum='$or' ORDER BY SUM(quantity) ASC";

                            $isql=mysqli_query($con,$sales);
                            while($irow=mysqli_fetch_array($isql)): //from items
                              $prodnum=$irow['productNum'];
                              $item="SELECT * FROM inventory WHERE  productNum ='$prodnum' ";

                              $quan="SELECT SUM(quantity)  FROM items WHERE productNum='$prodnum'";
                              $qsql=mysqli_query($con,$quan);
                              $qrow=mysqli_fetch_array($qsql);

                              $psql=mysqli_query($con,$item);
                              $prow=mysqli_fetch_array($psql); //from inventory 
                                if ($same != $prow['productNum']){
                                    $array_item[$count]= $prow['productNum'];
                                  
                                    $count++;
                                }               
                            endwhile; //end of items
                          endwhile; //end of cash_sales
                      else:  echo '<p style="color:red; font-size: 20px;">No Records Yet</p>';
                      endif;
                    
                      //cash 
                      if (mysqli_num_rows($fsqlinv) > 0):
                          while($frow=mysqli_fetch_array($fsqlinv)): //from cash_invoiceinvoice
                            $invoice=$frow['chargeInvoiceNum'];
                            $ciInvoice[$count]= $frow['chargeInvoiceNum'];
                            $sales="SELECT SUM(quantity), productNum FROM items WHERE chargeInvoiceNum='$invoice' ORDER BY SUM(quantity) ASC";
                            $isql=mysqli_query($con,$sales);
                            while($irow=mysqli_fetch_array($isql)): //from items
                              $prodnum=$irow['productNum'];
                              $item="SELECT * FROM inventory WHERE  productNum ='$prodnum' ";
                              $psql=mysqli_query($con,$item);
                              $prow=mysqli_fetch_array($psql); //from inventory 
                                if ($same != $prow['productNum']){
                                    $array_invoice[$count]= $prow['productNum'];
                                   
                                    $count++;
                                  
                                }
                            endwhile; //end of items
                          endwhile; //end of cash_invoice
                      endif;

                   
            //combining the cash_transaction and charge_invoice
            //displays items one by one from the array.
              if (mysqli_num_rows($fsqlinv) > 0 && mysqli_num_rows($fsql) > 0){
                      $combine=array_merge($array_item,$array_invoice);
                      $new=(array_values(array_unique($combine)));
                       
                        for($i = 0; $i < count($new); $i++){
                           $pick= $new[$i];
                           $check="SELECT SUM(quantity) FROM items WHERE productNum='$pick'";
                           $chsql=mysqli_query($con,$check);
                           $chrow=mysqli_fetch_array($chsql);
                           $display="SELECT * FROM inventory WHERE productNum='$pick' ";
                           $dsql=mysqli_query($con,$display);
                           $drow=mysqli_fetch_array($dsql);
                                    echo "<tr>";
                                    echo "<td style='border-color:white'>". $drow['itemName']."</td>";
                                    echo "<td style='text-align: center;border-color:white'>". $chrow['SUM(quantity)']."</td>";
                                    echo "</tr>"; 
                        }
                    }
               else { 
                      if(mysqli_num_rows($fsql) > 0){
                           $new=array_unique($array_item);
                               for($i = 0; $i < count($new); $i++){

                               $pick= $new[$i];
                               $check="SELECT SUM(quantity) FROM items WHERE productNum='$pick'"; //Sum of the prodnum
                               $chsql=mysqli_query($con,$check);
                               $chrow=mysqli_fetch_array($chsql);
                               $display="SELECT * FROM inventory WHERE productNum='$pick' ";
                               $dsql=mysqli_query($con,$display);
                               $drow=mysqli_fetch_array($dsql);
                                        echo "<tr>";
                                        echo "<td style='border-color:white'> ". $drow['itemName']."</td>";
                                        echo "<td style='text-align: center; border-color:white'>". $chrow['SUM(quantity)']."</td>";
                                        echo "</tr>"; 
                              }
                      }

                      if(mysqli_num_rows($fsqlinv) > 0){
                           $new=array_unique($array_invoice);
                               for($i = 0; $i < count($new); $i++){
                               $pick= $new[$i];
                              
                               $check="SELECT SUM(quantity) FROM items WHERE productNum='$pick'"; //Sum of the prodnum
                               $chsql=mysqli_query($con,$check);
                               $chrow=mysqli_fetch_array($chsql);
                               $display="SELECT * FROM inventory WHERE productNum='$pick' ";
                               $dsql=mysqli_query($con,$display);
                               $drow=mysqli_fetch_array($dsql);
                                        echo "<tr>";
                                        echo "<td  style='border-color:white'>". $drow['itemName']."</td>";
                                        echo "<td style='text-align:center; border-color:white'>". $chrow['SUM(quantity)']."</td>";
                                        echo "</tr>"; 
                              }
                      }
               }

?>  