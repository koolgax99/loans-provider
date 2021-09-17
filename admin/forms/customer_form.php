<fieldset>
    <div class="form-group">
        <label for="f_name">First Name *</label>
        <input type="text" name="f_name" value="<?php echo htmlspecialchars($edit ? $customer['f_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="First Name" class="form-control" required="required" id="f_name">
    </div>

    <div class="form-group">
        <label for="l_name">Last name *</label>
        <input type="text" name="l_name" value="<?php echo htmlspecialchars($edit ? $customer['l_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Last Name" class="form-control" required="required" id="l_name">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($edit ? $customer['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="E-Mail Address" class="form-control" id="email">
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input name="phone" value="<?php echo htmlspecialchars($edit ? $customer['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
    </div>

    <div class="form-group">
        <label>Gender * </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="Male" <?php echo ($edit && $customer['gender'] == 'Male') ? "checked" : ""; ?> required="required" /> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" value="Female" <?php echo ($edit && $customer['gender'] == 'Female') ? "checked" : ""; ?> required="required" id="female" /> Female
        </label>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" placeholder="Address" class="form-control" id="address"><?php echo htmlspecialchars(($edit) ? $customer['address'] : '', ENT_QUOTES, 'UTF-8'); ?></textarea>
    </div>

    <div class="form-group">
        <label for="city">City</label>
        <input name="city" value="<?php echo htmlspecialchars($edit ? $customer['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="city">
    </div>

    <div class="form-group">
        <label for="district">District</label>
        <input name="district" value="<?php echo htmlspecialchars($edit ? $customer['district'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="district">
    </div>

    <div class="form-group">
        <label for="pincode">Pin Code</label>
        <input name="pincode" value="<?php echo htmlspecialchars($edit ? $customer['pincode'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="pincode">
    </div>

    
    
    <div class="form-group">
        <label>State </label>
        <?php $opt_arr = array(
            "Andra Pradesh",
            "Arunachal Pradesh",
            "Assam",
            "Bihar",
            "Chhattisgarh",
            "Goa",
            "Gujarat",
            "Haryana",
            "Himachal Pradesh",
            "Jammu and Kashmir",
            "Jharkhand",
            "Karnataka",
            "Kerala",
            "Madya Pradesh",
            "Maharashtra",
            "Manipur",
            "Meghalaya",
            "Mizoram",
            "Nagaland",
            "Odisha",
            "Punjab",
            "Rajasthan",
            "Sikkim",
            "Tamil Nadu",
            "Telangana",
            "Tripura",
            "Uttarakhand",
            "Uttar Pradesh",
            "West Bengal",
            "Andaman and Nicobar Islands",
            "Chandigarh",
            "Dadar and Nagar Haveli",
            "Daman and Diu",
            "Delhi",
            "Lakshadweep",
            "Pondicherry"
        );
        ?>
        <select name="state" class="form-control selectpicker" required>
            <option value=" ">Please select your state</option>
            <?php
            foreach ($opt_arr as $opt) {
                if ($edit && $opt == $customer['state']) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                echo '<option value="' . $opt . '"' . $sel . '>' . $opt . '</option>';
            }
            
            ?>
        </select>
    </div>
    
    
    <div class="form-group">
        <label>Date of birth</label>
        <input name="date_of_birth" value="<?php echo htmlspecialchars($edit ? $customer['date_of_birth'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Birth date" class="form-control" type="date">
    </div>
    
    
    <div class="form-group">
        <label>Qualification </label>
        <?php $opt_arr = array(
              "Non-metric",
              "Metric",
              "Intermediate",
              "Gradutions",
              "Post-Gradution",
            );
            ?>
        <select name="qualification" class="form-control selectpicker" required>
            <option value=" ">Please select your Qualification</option>
            <?php
            foreach ($opt_arr as $opt) {
                if ($edit && $opt == $customer['qualification']) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                echo '<option value="' . $opt . '"' . $sel . '>' . $opt . '</option>';
            }

            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label>Bank </label>
        <?php $opt_arr = array(
              "State Bank of India",
              "Punjab National Bank",
              "Bank of Baroda",
              "Bank of India",
              "Central Bank of India",
              "Canara Bank",
              "Allahabad Bank",
              "ICICI Bank",
              "Axis Bank",
              "Bandhan Bank",
              "Union Bank of India",
              "United Bank of India",
              "Uttar Bihar Gramin Bank",
              "Madhya Bihar Gramin Bank",
              "Canara Bank",
              "Bihar Kshetriya Gramin Bank",
              "UCO Bank",
              "Indian Bank",
              "Others");
              ?>
        <select name="bank" class="form-control selectpicker" required>
            <option value=" ">Please select your bank</option>
            <?php
            foreach ($opt_arr as $opt) {
                if ($edit && $opt == $customer['bank']) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                echo '<option value="' . $opt . '"' . $sel . '>' . $opt . '</option>';
            }
            
            ?>
        </select>
    </div>
    
        <div class="form-group">
            <label for="reg_no">Registration No</label>
            <input name="reg_no" value="<?php echo htmlspecialchars($edit ? $customer['reg_no'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="father_name">Father Name</label>
            <input name="father_name" value="<?php echo htmlspecialchars($edit ? $customer['father_name'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="adhaar_number">Aadhaar No</label>
            <input name="adhaar_number" value="<?php echo htmlspecialchars($edit ? $customer['adhaar_number'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="pan_number">PAN No</label>
            <input name="pan_number" value="<?php echo htmlspecialchars($edit ? $customer['pan_number'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="village">Village</label>
            <input name="village" value="<?php echo htmlspecialchars($edit ? $customer['village'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="organization">Organization</label>
            <input name="organization" value="<?php echo htmlspecialchars($edit ? $customer['organization'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="account_no">Account No</label>
            <input name="account_no" value="<?php echo htmlspecialchars($edit ? $customer['account_no'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
        
        <div class="form-group">
            <label for="ifsc_code">IFSC Code</label>
            <input name="ifsc_code" value="<?php echo htmlspecialchars($edit ? $customer['ifsc_code'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="reg_fee">Registration Fee</label>
            <input name="reg_fee" value="<?php echo htmlspecialchars($edit ? $customer['reg_fee'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="reg_status">Registration Status</label>
            <input name="reg_status" value="<?php echo htmlspecialchars($edit ? $customer['reg_status'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="loan_amount">Loan Amount</label>
            <input name="loan_amount" value="<?php echo htmlspecialchars($edit ? $customer['loan_amount'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="loan_period">Loan Period</label>
            <input name="loan_period" value="<?php echo htmlspecialchars($edit ? $customer['loan_period'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="monthly_emi">Monthly EMI</label>
            <input name="monthly_emi" value="<?php echo htmlspecialchars($edit ? $customer['monthly_emi'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control" type="text" id="phone">
        </div>
    
        <div class="form-group">
            <label for="rate">Rate</label>
            <input name="rate" value="<?php echo htmlspecialchars($edit ? $customer['rate'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Enter Rate" class="form-control" type="text" id="phone">
        </div>

        
        <div class="form-group">
        <label>Application Status</label>
        <?php $opt_arr = array("PENDING","VERIFIED");
            
              ?>
        <select name="verified" class="form-control selectpicker" required>
            <?php

                if($customer['verified']=='0')
                {
                    echo '<option value="0" selected>PENDING</option>';
                    echo '<option value="1">VERIFIED</option>';
                }
                else
                {
                    echo '<option value="0">PENDING</option>';
                    echo '<option value="1" selected>VERIFIED</option>';
                }            
            ?>
        </select>
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning">Save <span class="glyphicon glyphicon-send"></span></button>
    </div>

</fieldset>
