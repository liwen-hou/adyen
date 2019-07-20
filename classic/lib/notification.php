<?php
date_default_timezone_set("Asia/Singapore");
?>

<script type="text/javascript">
 // For IdentifyShopper (3DSMethod) flow
 // NOTE: This redirect of the iframe should have happened within 10 seconds of POST-ing the form to the
 // threeDSMethodURL otherwise threeDSCompInd should be set to 'N'

     const data = {
         type: 'identifyShopper',
         threeDSCompInd: 'Y'
     };
 // // For ChallengeShopper flow
 // // NOTE: This redirect of the iframe should have happened within 10 minutes of POST-ing the form
 // // to the acsURL otherwise transStatus should be set to 'U'
 // const data = {
 //         type: 'challengeShopper',
 //         transStatus: 'Y',
 // threeDSServerTransID: threeds2.threeDS2ResponseData.threeDSServerTransID
 //     };

    if (<?php echo $_POST;?>) {
      window.parent.postMessage(data, "https://18.138.204.96/classic/index.php");
    }


</script>
