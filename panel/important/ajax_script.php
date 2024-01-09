<?php
include('const.php');
include('connect.php');
include('function.php');
$ajax = filter($_POST['ajax']);
$build = filter($_POST['build']);
if($ajax=="true"){
    $responseMessage=array();
    if($build=="ProductPriceScript")
    {

        $return = [
            'response'=>'',
            'responseMessage'=>'',
        ];

        
        $return['response'] .= "
            <script>
                function calculatePercentageDiscount(value='') {

                    var pPrice = parseFloat(document.getElementById('p_price').value);
                    var pDiscount = parseFloat(document.getElementById('p_discount').value);
                    var pPercentage = parseFloat(document.getElementById('p_percentage').value);
                    
                    if(value=='')
                    {
                            var percentageDiscount = ((pPrice - pDiscount) / pPrice) * 100;
                            console.log(pDiscount);
                            if(percentageDiscount<=0 || pDiscount=='')
                            {
                                document.getElementById('p_percentage').value = 0;
                                document.getElementById('p_discount').value = 0;
                            }
                            else
                            {
                                document.getElementById('p_percentage').value = percentageDiscount.toFixed(2);
                            }
                    }
                    else if(value=='yuzde')
                    {
                        var calculatedDiscount = (pPrice * pPercentage) / 100;
                        var deger= pPrice-calculatedDiscount;
                        if (calculatedDiscount <= 0) {
                            document.getElementById('p_discount').value = 0;
                            document.getElementById('p_percentage').value = 0;
                        } else {
                            document.getElementById('p_discount').value = deger.toFixed(2);
                            document.getElementById('p_percentage').value = pPercentage;
                        }
                    }
                    else
                    {
                        
                    }

                }
            </script>
        ";

        echo json_encode($return);
       
    }


}
