<?php
session_start();
if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') {
    // echo "Logged In.";
} else {
    //when using redirect, make sure that everything else works first. If not, remove redirect to debug.
    // echo "Not Logged In.";
    header("Location:login.php");
}
include("../includes/header.php");
include("../includes/_functions.php");
?>

<div class="row container">
    <div class="col-8" style="height:609px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">

        <h2>Edit</h2>

        <?php
        $cid = $_GET['id']; // page-setter variable
        //if not set we will give this a default value
        if (!isset($cid)) {
            $result = mysqli_query($con, "SELECT cid FROM cheese_db LIMIT 1") or die(mysqli_error($con));
            while ($row = mysqli_fetch_array($result)) {

                $cid = $row['cid'];
            }
        }


        // Step 3: If the user clicks submit, validate
        if (isset($_POST['submit'])) {
            $cheese = $_POST['cheese'];
            $classification = $_POST['classification'];
            $age = $_POST['age'];
            $price = $_POST['price'];
            $type = $_POST['type'];
            $country = $_POST['country'];
            $description = $_POST['description'];
            // echo "$cheese, $type, $description, $cid"; // this is for testing

            $valid = 1;
            $valMessage .= "";

            $msgPreError = "<div class=\"alert alert-danger\" role=\"alert\">";
            $msgPreSuccess = "<div class=\"alert alert-success\" role=\"alert\">";
            $msgPost = "</div>";

            if ((strlen($cheese) < 3) || (strlen($cheese) > 20)) {
                $valid = 0;
                // specific message
                $valCheeseMsg = "Please enter a cheese between 3 and 20 characters.";
            }
            if ($classification == "") {
                $valid = 0;
                // specific message
                $valClassMsg = "Please select a classification.";
            }
            if ((strlen($description) < 20) || (strlen($description) > 512)) {
                $valid = 0;
                // specific message
                $valDescMsg = "Please enter a description between 20 and 512 characters.";
            }
            if ($type == "") {
                $valid = 0;
                // specific message
                $valTypeMsg = "Please select a type of milk.";
            }
            if ($country == "") {
                $valid = 0;
                // specific message
                $valCountryMsg = "Please select a country.";
            }
            // success. if our boolean is still 1 then user form data is good.
            if ($valid == 1) {
                $cheese = $_POST['cheese'];
                $classification = $_POST['classification'];
                $age = $_POST['age'];
                $price = (float) $_POST['price'];
                $type = $_POST['type'];
                $country = $_POST['country'];
                $description = $_POST['description'];

                $msgSuccess = "Success! Form data has been stored.";
                // Editing or changing data in a DB: UPDATE
                mysqli_query($con, "UPDATE cheese_db SET 
                cheese = '$cheese', 
                classification = '$classification',
                age = '$age',
                price = '$price', 
                type = '$type', 
                country = '$country', 
                description = '$description'
                WHERE cid = $cid") or die(mysqli_error($con));
            }
        }
        // echo "<h1>$cid</h1>";


        // Step 1: Create a list characters which the user can select from
        // Reading from a DB: SELECT
        $result = mysqli_query($con, "SELECT * FROM cheese_db") or die(mysqli_error($con));
        // loop trhough results
        while ($row = mysqli_fetch_array($result)) {
            $l_image = $row['image_file'];
            $l_id = $row['cid'];


            $editLinks .= "\n<a class=\"edit-link\" id=\"style-links\" href=\"edit.php?id=$l_id\"><img style=\"margin-bottom:0.3rem\" src=\"../images/squares50/$l_image\" alt=\"thumbnail\" /></a>";
        }
        // echo "<h1>$cid</h1>";
        // echo "<h1>$cheese</h1>";

        // Step 2: Prepopulate the fields based on the selected character
        $result = mysqli_query($con, "SELECT * FROM cheese_db WHERE cid = '$cid'") or die(mysqli_error($con));
        // loop trhough results
        while ($row = mysqli_fetch_array($result)) {
            $cheese = $row['cheese'];
            $classification = $row['classification'];
            $age = $row['age'];
            $price = $row['price'];
            $type = $row['type'];
            $country = $row['country'];
            $description = $row['description'];
            $image = $row['image_file'];
        }

        // echo "<h1>$cid</h1>";
        // echo "<h1>$cheese</h1>";
        ?>
        <?php if ($valid == 1) {
            echo $msgPreSuccess . $msgSuccess . $msgPost;
        } ?>
        <div class="row">
            <div class="col-9">
                <form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                    <div class="form-group">
                        <label for="cheese">Cheese:</label>
                        <input type="text" name="cheese" class="form-control" value="<?php if ($cheese) {
                                                                                            echo $cheese;
                                                                                        } ?>">
                        <?php if ($valCheeseMsg) {
                            echo $msgPreError . $valCheeseMsg . $msgPost;
                        } ?>
                    </div>






                    <div class="form-group">
                        <label for="classification">Classification:</label><br />
                        Hard:<input type="radio" value="Hard" name="classification" <?php if (isset($classification) && $classification == "Hard") {
                                                                                        echo "checked";
                                                                                    } ?>><br />
                        Semi-Hard:<input type="radio" value="Semi-Hard" name="classification" <?php if (isset($classification) && $classification == "Semi-Hard") {
                                                                                                    echo "checked";
                                                                                                } ?>><br />

                        Semi-Soft:<input type="radio" value="Semi-Soft" name="classification" <?php if (isset($classification) && $classification == "Semi-Soft") {
                                                                                                    echo "checked";
                                                                                                } ?>><br />
                        Soft:<input type="radio" value="Soft" name="classification" <?php if (isset($classification) && $classification == "Soft") {
                                                                                        echo "checked";
                                                                                    } ?>><br />
                        Blue:<input type="radio" value="Blue" name="classification" <?php if (isset($classification) && $classification == "Blue") {
                                                                                        echo "checked";
                                                                                    } ?>><br />
                        <?php if ($valClassMsg) {
                            echo $msgPreError . $valClassMsg . $msgPost;
                        } ?>
                    </div>


                    <div class="form-group">
                        <label for="age">Age (# months):</label>
                        <input type="number" name="age" class="form-control" value="<?php if ($age) {
                                                                                        echo $age;
                                                                                    } ?>">
                    </div>

                    <div class="form-group">
                        <label for="price">Price $/Lb:</label>
                        <input type="number" step="0.01" min="0.00" name="price" class="form-control" value="<?php if ($price) {
                                                                                                                    echo $price;
                                                                                                                } ?>">
                    </div>

                    <div class="form-group">
                        <label for="type">Milk Type:</label>
                        <select class="form-control" name="type">
                            <option value="">Please select a type</option>
                            <option <?php if (isset($type) && $type == "Buffalo") {
                                        echo "selected";
                                    } ?> value="Buffalo">Buffalo</option>
                            <option <?php if (isset($type) && $type == "Cow") {
                                        echo "selected";
                                    } ?> value="Cow">Cow</option>
                            <option <?php if (isset($type) && $type == "Goat") {
                                        echo "selected";
                                    } ?> value="Goat">Goat</option>
                            <option <?php if (isset($type) && $type == "Sheep") {
                                        echo "selected";
                                    } ?> value="Sheep">Sheep</option>
                        </select>
                        <?php if ($valTypeMsg) {
                            echo $msgPreError . $valTypeMsg . $msgPost;
                        } ?>
                    </div>

                    <div class="form-group">
				<label for="country">Country</label>
				<select id="country" name="country" class="form-control">
					<option value="">Please select a country</option>
					<!-- <option value="Afghanistan">Afghanistan</option>
					<option value="Åland Islands">Åland Islands</option>
					<option value="Albania">Albania</option>
					<option value="Algeria">Algeria</option>
					<option value="American Samoa">American Samoa</option>
					<option value="Andorra">Andorra</option>
					<option value="Angola">Angola</option>
					<option value="Anguilla">Anguilla</option>
					<option value="Antarctica">Antarctica</option>
					<option value="Antigua and Barbuda">Antigua and Barbuda</option>
					<option value="Argentina">Argentina</option>
					<option value="Armenia">Armenia</option>
					<option value="Aruba">Aruba</option>
					<option value="Australia">Australia</option>
					<option value="Austria">Austria</option>
					<option value="Azerbaijan">Azerbaijan</option>
					<option value="Bahamas">Bahamas</option>
					<option value="Bahrain">Bahrain</option>
					<option value="Bangladesh">Bangladesh</option>
					<option value="Barbados">Barbados</option>
					<option value="Belarus">Belarus</option>
					<option value="Belgium">Belgium</option>
					<option value="Belize">Belize</option>
					<option value="Benin">Benin</option>
					<option value="Bermuda">Bermuda</option>
					<option value="Bhutan">Bhutan</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
					<option value="Botswana">Botswana</option>
					<option value="Bouvet Island">Bouvet Island</option>
					<option value="Brazil">Brazil</option>
					<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
					<option value="Brunei Darussalam">Brunei Darussalam</option>
					<option value="Bulgaria">Bulgaria</option>
					<option value="Burkina Faso">Burkina Faso</option>
					<option value="Burundi">Burundi</option>
					<option value="Cambodia">Cambodia</option>
					<option value="Cameroon">Cameroon</option> -->
					<option <?php if (isset($country) && $country == "Canada") {
								echo "selected";
							} ?> value="Canada">Canada</option>
					<!-- <option value="Cape Verde">Cape Verde</option>
					<option value="Cayman Islands">Cayman Islands</option>
					<option value="Central African Republic">Central African Republic</option>
					<option value="Chad">Chad</option>
					<option value="Chile">Chile</option>
					<option value="China">China</option>
					<option value="Christmas Island">Christmas Island</option>
					<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
					<option value="Colombia">Colombia</option>
					<option value="Comoros">Comoros</option>
					<option value="Congo">Congo</option>
					<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
					<option value="Cook Islands">Cook Islands</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Cote D'ivoire">Cote D'ivoire</option>
					<option value="Croatia">Croatia</option>
					<option value="Cuba">Cuba</option>
					<option value="Cyprus">Cyprus</option>
					<option value="Czech Republic">Czech Republic</option> -->
					<option <?php if (isset($country) && $country == "Denmark") {
								echo "selected";
							} ?> value="Denmark">Denmark</option>
					<!-- <option value="Djibouti">Djibouti</option>
					<option value="Dominica">Dominica</option>
					<option value="Dominican Republic">Dominican Republic</option>
					<option value="Ecuador">Ecuador</option>
					<option value="Egypt">Egypt</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Equatorial Guinea">Equatorial Guinea</option>
					<option value="Eritrea">Eritrea</option>
					<option value="Estonia">Estonia</option>
					<option value="Ethiopia">Ethiopia</option>
					<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
					<option value="Faroe Islands">Faroe Islands</option>
					<option value="Fiji">Fiji</option> -->
					<option <?php if (isset($country) && $country == "Finland") {
								echo "selected";
							} ?> value="Finland">Finland</option>
					<option <?php if (isset($country) && $country == "France") {
								echo "selected";
							} ?> value="France">France</option>
					<!-- <option value="French Guiana">French Guiana</option>
					<option value="French Polynesia">French Polynesia</option>
					<option value="French Southern Territories">French Southern Territories</option>
					<option value="Gabon">Gabon</option>
					<option value="Gambia">Gambia</option>
					<option value="Georgia">Georgia</option>
					<option value="Germany">Germany</option>
					<option value="Ghana">Ghana</option>
					<option value="Gibraltar">Gibraltar</option>
					<option value="Greece">Greece</option>
					<option value="Greenland">Greenland</option>
					<option value="Grenada">Grenada</option>
					<option value="Guadeloupe">Guadeloupe</option>
					<option value="Guam">Guam</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Guernsey">Guernsey</option>
					<option value="Guinea">Guinea</option>
					<option value="Guinea-bissau">Guinea-bissau</option>
					<option value="Guyana">Guyana</option>
					<option value="Haiti">Haiti</option>
					<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
					<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
					<option value="Honduras">Honduras</option>
					<option value="Hong Kong">Hong Kong</option>
					<option value="Hungary">Hungary</option>
					<option value="Iceland">Iceland</option>
					<option value="India">India</option>
					<option value="Indonesia">Indonesia</option>
					<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
					<option value="Iraq">Iraq</option>
					<option value="Ireland">Ireland</option>
					<option value="Isle of Man">Isle of Man</option>
					<option value="Israel">Israel</option> -->
					<option <?php if (isset($country) && $country == "Italy") {
								echo "selected";
							} ?> value="Italy">Italy</option>
					<!-- <option value="Jamaica">Jamaica</option>
					<option value="Japan">Japan</option>
					<option value="Jersey">Jersey</option>
					<option value="Jordan">Jordan</option>
					<option value="Kazakhstan">Kazakhstan</option>
					<option value="Kenya">Kenya</option>
					<option value="Kiribati">Kiribati</option>
					<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
					<option value="Korea, Republic of">Korea, Republic of</option>
					<option value="Kuwait">Kuwait</option>
					<option value="Kyrgyzstan">Kyrgyzstan</option>
					<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
					<option value="Latvia">Latvia</option>
					<option value="Lebanon">Lebanon</option>
					<option value="Lesotho">Lesotho</option>
					<option value="Liberia">Liberia</option>
					<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
					<option value="Liechtenstein">Liechtenstein</option>
					<option value="Lithuania">Lithuania</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Macao">Macao</option>
					<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
					<option value="Madagascar">Madagascar</option>
					<option value="Malawi">Malawi</option>
					<option value="Malaysia">Malaysia</option>
					<option value="Maldives">Maldives</option>
					<option value="Mali">Mali</option>
					<option value="Malta">Malta</option>
					<option value="Marshall Islands">Marshall Islands</option>
					<option value="Martinique">Martinique</option>
					<option value="Mauritania">Mauritania</option>
					<option value="Mauritius">Mauritius</option>
					<option value="Mayotte">Mayotte</option> -->
					<option <?php if (isset($country) && $country == "Mexico") {
								echo "selected";
							} ?> value="Mexico">Mexico</option>
					<!-- <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
					<option value="Moldova, Republic of">Moldova, Republic of</option>
					<option value="Monaco">Monaco</option>
					<option value="Mongolia">Mongolia</option>
					<option value="Montenegro">Montenegro</option>
					<option value="Montserrat">Montserrat</option>
					<option value="Morocco">Morocco</option>
					<option value="Mozambique">Mozambique</option>
					<option value="Myanmar">Myanmar</option>
					<option value="Namibia">Namibia</option>
					<option value="Nauru">Nauru</option>
					<option value="Nepal">Nepal</option> -->
					<option <?php if (isset($country) && $country == "Netherlands") {
								echo "selected";
							} ?> value="Netherlands">Netherlands</option>
					<!-- <option value="Netherlands Antilles">Netherlands Antilles</option>
					<option value="New Caledonia">New Caledonia</option>
					<option value="New Zealand">New Zealand</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Niger">Niger</option>
					<option value="Nigeria">Nigeria</option>
					<option value="Niue">Niue</option>
					<option value="Norfolk Island">Norfolk Island</option>
					<option value="Northern Mariana Islands">Northern Mariana Islands</option> -->
					<option <?php if (isset($country) && $country == "Norway") {
								echo "selected";
							} ?> value="Norway">Norway</option>
					<!-- <option value="Oman">Oman</option>
					<option value="Pakistan">Pakistan</option>
					<option value="Palau">Palau</option>
					<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
					<option value="Panama">Panama</option>
					<option value="Papua New Guinea">Papua New Guinea</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Peru">Peru</option>
					<option value="Philippines">Philippines</option>
					<option value="Pitcairn">Pitcairn</option>
					<option value="Poland">Poland</option>
					<option value="Portugal">Portugal</option>
					<option value="Puerto Rico">Puerto Rico</option>
					<option value="Qatar">Qatar</option>
					<option value="Reunion">Reunion</option>
					<option value="Romania">Romania</option>
					<option value="Russian Federation">Russian Federation</option>
					<option value="Rwanda">Rwanda</option>
					<option value="Saint Helena">Saint Helena</option>
					<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
					<option value="Saint Lucia">Saint Lucia</option>
					<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
					<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
					<option value="Samoa">Samoa</option>
					<option value="San Marino">San Marino</option>
					<option value="Sao Tome and Principe">Sao Tome and Principe</option>
					<option value="Saudi Arabia">Saudi Arabia</option>
					<option value="Senegal">Senegal</option>
					<option value="Serbia">Serbia</option>
					<option value="Seychelles">Seychelles</option>
					<option value="Sierra Leone">Sierra Leone</option>
					<option value="Singapore">Singapore</option>
					<option value="Slovakia">Slovakia</option>
					<option value="Slovenia">Slovenia</option>
					<option value="Solomon Islands">Solomon Islands</option>
					<option value="Somalia">Somalia</option>
					<option value="South Africa">South Africa</option>
					<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> -->
					<option <?php if (isset($country) && $country == "Spain") {
								echo "selected";
							} ?> value="Spain">Spain</option>
					<!-- <option value="Sri Lanka">Sri Lanka</option>
					<option value="Sudan">Sudan</option>
					<option value="Suriname">Suriname</option>
					<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
					<option value="Swaziland">Swaziland</option>
					<option value="Sweden">Sweden</option> -->
					<option <?php if (isset($country) && $country == "Switzerland") {
								echo "selected";
							} ?> value="Switzerland">Switzerland</option>
					<!-- <option value="Syrian Arab Republic">Syrian Arab Republic</option>
					<option value="Taiwan, Province of China">Taiwan, Province of China</option>
					<option value="Tajikistan">Tajikistan</option>
					<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
					<option value="Thailand">Thailand</option>
					<option value="Timor-leste">Timor-leste</option>
					<option value="Togo">Togo</option>
					<option value="Tokelau">Tokelau</option>
					<option value="Tonga">Tonga</option>
					<option value="Trinidad and Tobago">Trinidad and Tobago</option>
					<option value="Tunisia">Tunisia</option>
					<option value="Turkey">Turkey</option>
					<option value="Turkmenistan">Turkmenistan</option>
					<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
					<option value="Tuvalu">Tuvalu</option>
					<option value="Uganda">Uganda</option>
					<option value="Ukraine">Ukraine</option>
					<option value="United Arab Emirates">United Arab Emirates</option> -->
					<option <?php if (isset($country) && $country == "United Kingdom") {
								echo "selected";
							} ?> value="United Kingdom">United Kingdom</option>
					<option <?php if (isset($country) && $country == "United States") {
								echo "selected";
							} ?> value="United States">United States</option>
					<!-- <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
					<option value="Uruguay">Uruguay</option>
					<option value="Uzbekistan">Uzbekistan</option>
					<option value="Vanuatu">Vanuatu</option>
					<option value="Venezuela">Venezuela</option>
					<option value="Viet Nam">Viet Nam</option>
					<option value="Virgin Islands, British">Virgin Islands, British</option>
					<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
					<option value="Wallis and Futuna">Wallis and Futuna</option>
					<option value="Western Sahara">Western Sahara</option>
					<option value="Yemen">Yemen</option>
					<option value="Zambia">Zambia</option>
					<option value="Zimbabwe">Zimbabwe</option> -->
				</select>
				<?php if ($valCountryMsg) {
					echo $msgPreError . $valCountryMsg . $msgPost;
				} ?>
			</div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" class="form-control"><?php if ($description) {
                                                                                echo $description;
                                                                            } ?></textarea>
                        <?php if ($valDescMsg) {
                            echo $msgPreError . $valDescMsg . $msgPost;
                        } ?>
                    </div>

                    <div class="form-group">
                        <label for="submit">&nbsp;</label>
                        <input type="submit" name="submit" class="btn btn-warning" value="Update">
                        <a class="btn btn-danger del" style="font-size:1rem;" href="delete.php?id=<?php echo $cid ?>">Delete</a>
                        <script>
                            $(document).ready(function() {
                                $(".del").click(function() {
                                    if (!confirm("Do you want to delete")) {
                                        return false;
                                    }
                                });
                            });
                        </script>
                    </div>
                </form>
            </div>
            <div class="col-3" style="height:685px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">
                <style>
                    .edit-link img:hover {
                        box-shadow: 0 0 5px 0 blue;
                    }
                </style>
                <?php echo $editLinks; ?>
            </div>
        </div>


        <?php
        include("../includes/footer.php");
        ?>