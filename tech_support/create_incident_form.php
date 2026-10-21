<?php $customer = "Joe Smith"; // Temporary value for variable, replace when required ?>
<?php require_once('model/database.php');
require('incident_create/model/email_db.php'); 
    
$errorMessage = "";
$cleanEmail = "";
$rawEmail = filter_input(INPUT_POST, 'customer-email', FILTER_UNSAFE_RAW);
if($rawEmail === null || $rawEmail === false) {
    $errorMessage = "Email is required.";
} else {
    $cleanEmail = strtolower(trim($rawEmail));
    if(!filter_var($cleanEmail, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email format.";
    }
}

if (!$errorMessage) {
    try {
        $userData = find_email($cleanEmail);
        if (empty($userData)) {
            $errorMessage = "Customer not found.";
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}

?>

<?php include 'view/header.php'; ?>
<main>
    <h2 id="incident-header">Create Incident</h2>
    <form action="create_incident.php" id="incident-form" method="post">
        <div>
            <label for="incident-customer">Customer: </label>
            <span style="margin-left: 62px;">
                <!--?php echo $userData['fullName']; ?> -->
                 <?php echo $errorMessage ? htmlspecialchars($errorMessage) : htmlspecialchars($userData['fullName']); ?>
            </span>
        </div>

        <div>
            <label for="incident-product">Product: </label>
            <select name="incident-product" form="incident-form">
                <?php // Code for displaying options dynamically
                $options = ['One', 'Two', 'Three'];
                foreach ($options as $option) {
                    echo "<option value='$option'>$option</option>";
                }
                ?>
            </select>  
        </div>

        <div>
            <label for="incident-title">Title: </label>
            <input style="margin-left: 95px;" type="text" name="incident-customer">
        </div>

        <div>
            <label style="position: relative; bottom: 70px;" for="incident-description">Description: </label>
            <textarea style="margin-left: 50px;" name="incident-description" rows="5" cols="50"></textarea>
        </div>

        <input id="create-incident" type="submit" value="Create Incident">
    </form>
    </div>

</main>

<style>
    #incident-header {
        margin-bottom: 0;
    }

    #incident-form {
        div {
            margin: 8px 0 8px 0;

            select {
                margin-left: 75px; 
                height: 22px; 
                width: 177px;
            }
        }

        #create-incident {
            margin-left: 133px;
        }
    }
    
</style>

<?php include 'view/footer.php'; ?>