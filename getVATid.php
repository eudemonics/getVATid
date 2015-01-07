<?php
/* auto-incrementing brute force queries against web service in search of valid VAT ID's belonging to a specific country.
*** VAT number formats for each specific EU country can be found in README.MD file,
or at the following link:
http://www.pixelgenius.com/vat-id.html
Just change countryCode value to the country of your choice,
and modify the for loop to match that country's algorithm */
 
ini_set('default_socket_timeout',10);
 
/*set 11-digit string to start the search from */
$vatIdinit = '0011223141516';
$count = 0;
$match = 0;
 
?>
<html>
<head>
<title>SEQUENTIAL VAT FINDER</title>
</head>
 
<body>
 
<?php
 
print "<h2>starting search...</h2>";
 
/* Initialize web service with WSDL */
$client = new SoapClient("http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl");
 
echo "<h3>connecting to SOAP..</h3><br />";
 
//if VAT ID is passed through GET paramater in URL
if (isset($_GET["id"]) && ctype_digit($_GET["id"])) {
    $vatId = $_GET["id"];
       
        /* Set parameters for the request */
        $params = array(
          "countryCode" => "IT",
          "vatNumber" => $vatId
        );
       
        /* Web service request */
        $return = $client->checkVat($params);
       
        echo "<b>RAW RESPONSE:</b><br /><br />";
        var_dump($return);
        echo "<br />";
        $valid = $return->valid;
       
        if (!$valid) {
                echo "<br /><h3><b style='color:#600';>".$vatId."</b> is not valid.</h3><br />";
        }
       
        else {
                /* Parse response from web service */
                $countryCode = $return->countryCode;
                $rawvalid = $return->valid;
                $vatNumber = $return->vatNumber;
                $requestDate = substr(($return->requestDate),0,10);
                $name = $return->name;
                $address = $return->address;
               
                print "<br /><br /><b>Valid VAT number found in ".$countryCode.":</b><br />";
                print "<h3 style='color:#600;'><b>".$vatNumber."</b></h3>";
                print "<b>Request Date: </b>".$requestDate."<br />";
                print "<b>Name: </b>".$name."<br />";
                print "<b>Address: </b>".$address."<br /><br />";
        }
        exit();
}
       
else {
        for ($i=0; $i<99999999999; $i++) {
                $vatId = str_pad(++$vatIdinit, 11, 0, STR_PAD_LEFT);
                ++$count;
               
                /* Set parameters for the request */
                $params = array(
                        "countryCode" => "IT",
                        "vatNumber" => $vatId
                );
           
                try {
                        /* Web service request */
                        $response = $client->checkVat($params);
                   
                    /* Parse response from web service */
                        $countryCode = $response->countryCode;
                        $rawvalid = $response->valid;
                        $valid = var_export($rawvalid,false);
                        $vatNumber = $response->vatNumber;
                        $requestDate = substr(($response->requestDate),0,10);
                        $name = $response->name;
                        $address = $response->address;
 
                        echo " - ";
 
                        if (!$rawvalid) {
                                echo "<b style='color:#600'>".$vatNumber."</b> not found.<br /><br />\n";
                        }
 
                        else {
                                $match++;
                                print "<b>Valid VAT number found in ".$countryCode.":</b><br />";
                                print "<b><h3 style='color:#600;'>".$vatNumber."</h3></b>";
                                echo $name."<br />";
                                echo $address."<br />";
                                echo $requestDate."<br />";
                                echo "count: ".$match." matches out of ".$count."<br /><br />";
                               
                                //add positive matches to text file
                                $vatfile = "vat-".$countryCode.".txt";
                                $savefile = fopen($vatfile, 'a') or die("can't open file");
                               
                                $arrMatch = array($vatNumber, $name, $address, $requestDate);
                                foreach ($arrMatch as &$data) {
                                        $write = $data."\n";
                                        fwrite($savefile, $write);
                                }
                                // break reference with the last element
                                unset($data);
                                $writeCount = "count: ".$match." matches out of ".$count."\n\n";
                                fwrite($savefile, $writeCount);
                                fclose($savefile);
                               
                                print $vatNumber." data added to ".$vatfile."<br /><br />";
                               
                                /*Launch new window with positive match result */
                                echo '<script type="text/javascript" language="javascript">
                                window.open("checkvat.php?id='.$vatNumber.'");
                                </script>';
 
                        }
                }
                catch (SoapFault $e) {
                        print "<b style='color:#600;'>SoapFault:</b> ";
                        echo print_r($e, true);
                        echo "<br /><br />";
                        print "<b style='color:#600;'>Count:</b> ";
                        echo print_r($count);
                        print "<br /><br />";
                }
        }
}
 
?>
</body>
</html>
