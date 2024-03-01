<?php 
use \JustGeeky\LaravelCybersource\CybersourceHelper;

session_start();
$sess_id  = session_id();
$df_param = 'org_id=' . DF_ORG_ID . '&amp;session_id=' . MERCHANT_ID . $sess_id;

$endpoint_url = PAYMENT_URL;
// $endpoint_url = "https://testsecureacceptance.cybersource.com/payment";
echo $df_param; 
if (isset($_POST['transaction_type']) && ($_POST['transaction_type'] === 'create_payment_token')) {
    $endpoint_url = TOKEN_CREATE_URL;
}

?>
<!DOCTYPE html>
<html style="display:none;">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm1</title>
     <link rel="stylesheet" type="text/css" href="{{url('cybersource/assets/css/payment.css')}}"/>
</head>
<body>
<img src="{{url('cybersource/assets/img/logo-cybersource.png')}}" style="padding-bottom: 10px;" />

<h2>Review &amp; Confirm</h2>
<form id="payment_confirmation" action="<?php echo $endpoint_url; ?>" method="post">
{{csrf_token()}}

<?php
    foreach($data as $name => $value) {
        $params[$name] = $value;
    }
?>
<fieldset id="confirmation">
    <legend>Payment Details</legend>
    <div>
        <?php
            foreach($params as $name => $value) {
                echo "<div>";
                echo "<span class=\"fieldName\">" . $name . "</span><span class=\"fieldValue\">" . $value . "</span>";
                echo "</div>\n";
            }
        ?>
    </div>
    </fieldset>
    <?php
        foreach($params as $name => $value) {
            echo "<input type=\"hidden\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
        }
    ?>

    <input type="hidden" name="device_fingerprint_id" value="<?php echo $sess_id; ?>" />
    <input type="hidden" name="signature" value="<?php echo CybersourceHelper::sign($params, SECRET_KEY); ?>" />
    <input type="submit" id="btn_submit" value="Confirm"/>

</form>

<!-- DF START -->
device_fingerprint_param: <?php echo $df_param; ?>
<p style="background:url(https://h.online-metrix.net/fp/clear.png?<?php echo $df_param; ?>&amp;m=1)"></p>
<img src="https://h.online-metrix.net/fp/clear.png?<?php echo $df_param; ?>&amp;m=2" width="1" height="1" />
<!-- DF END -->
<script src="//code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
// $(document).ready(function () {
$("#btn_submit").trigger( "click" );
// });
</script>
</body>
</html>
