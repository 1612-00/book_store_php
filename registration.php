<?php 
	// connect db
	$db = mysqli_connect("localhost", "root", "", "LTWeb");

	// ------------------------------------------------UPDATE DATA-----------------------------------------------

	$nameErr = $phoneErr = $emailErr = $nationalityErr = $dobErr = $avatarErr = $themeErr = $descErr = "";
	$name = $phone = $email = $nationality = $dob = $avatar = $theme = $desc = "";

	// Kiểm tra dữ liệu được gửi lên
	if($_SERVER["REQUEST_METHOD"] == "POST") {

	// ----------------------------------------------CHECK DATA POSTED-------------------------------------------
		// Kiểm tra họ và tên
		if(empty($_POST["name"])) {
			$nameErr = "Thiếu họ tên.";
		}	else {
			$name = test_input($_POST["name"]);
		}

		if(empty($_POST["phone"])) {
			$phoneErr = "Thiếu số điện thoại.";
		}	else {
			$phone = test_input($_POST["phone"]);
		}

		if(empty($_POST["email"])) {
			$emailErr = "Thiếu email.";
		}	else {
			$email = test_input($_POST["email"]);
		}

		if(empty($_POST["nationality"])) {
			$nationalityErr = "Thiếu quốc tịch.";
		}	else {
			$nationality = test_input($_POST["nationality"]);
		}
		
		if(empty($_POST["dob"])) {
			$dobErr = "Thiếu ngày tháng năm sinh.";
		}	else {
			$dob = test_input($_POST["dob"]);
		}

		if(empty($_FILES["avatar"])) {
			$avatarErr = "Thiếu ảnh đại diện.";
		}	else {
			// ---------------------------------------------UPLOAD FILE--------------------------------------
			// Upload file ảnh avatar
			$target_dir = "FileToUpload/";
			$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($_FILES["avatar"]["tmp_name"]);
			  if($check !== false) {
			    // echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
			  } else {
			    // echo "File is not an image.";
			    $uploadOk = 0;
			  }
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  // echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
			    // echo "The file ". htmlspecialchars(basename( $_FILES["avatar"]["name"])). " has been uploaded.";
			  } else {
			    // echo "Sorry, there was an error uploading your file.";
			  }
			}

			$avatar = "http://localhost/book_store_web/FileToUpload/".basename($_FILES["avatar"]["name"]);

			// ---------------------------------------END UPLOAD FILE-----------------------------------------
		}

		if(empty($_POST["theme"])) {
			$themeErr = "Chọn chủ đề.";
		}	else {
			$theme = test_input($_POST["theme"]);
		}

		if(empty($_POST["desc"])) {
			$descErr = "Hãy ghi mô tả về bản thân và mong muốn yêu cầu từ chúng tôi.";
		}	else {
			$desc = test_input($_POST["desc"]);
		}

		// ------------------------------------------END CHECK DATA POSTED-----------------------------------------

		// --------------------------------------------INSERT DATA TO DB-------------------------------------------
		
		// nếu khách hàng không để trống dòng nào
		if($name !== "" && $phone !== "" && $email !== "" && $nationality !== "" && $dob !== "" && $avatar !== "" && $theme != "" && $desc !== "") {

			$sql = "INSERT INTO speakers (name, phone, email, nationality, dob, avatar, theme, description, isChecked) VALUES ('$name', '$phone', '$email', '$nationality', '$dob', '$avatar', '$theme', '$desc', 0)";

			if(mysqli_query($db, $sql)) {
	  		echo '<script type="text/javascript">alert("Gửi đăng ký thành công, chúng tôi sẽ liên lạc với bạn sớm nhất có thể!")</script>';
			} else {
	  		echo '<script type="text/javascript">alert("Đăng ký thất bại, xin hãy liên hệ với chúng tôi nếu bạn vẫn gặp tình trạng này!")</script>';
			}	
		} 

		// -----------------------------------------------END INSERT DATA---------------------------------------

	}

// ----------------------------------------------END UPDATE DATA--------------------------------------------

		// lọc dữ liệu post
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Multi Level</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css">

    <style type="text/css">
    	
    	.error {
    		color: red;
    	}

    </style>
    
</head>
<body>
    <!-- Thanh navbar -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="./index.php">LOGO</a>
        </div>        
    </nav>

    <!-- form ordered -->
    <div class="container-fluid bg-light" style="padding: 50px;">
        <div class="container" style="width: 50%;">
            <div class="form-ordered">
                <h3 class="text-center"><strong>Đăng ký tham dự</strong></h3>
                <p class="text-center">Hãy đăng ký để làm diễn giả, nhà tài trợ hay những tiết mục nghệ thuật trong buổi hội thảo!</p>
                <br>

                <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                	
                    <div class="form-group">
                        <label for="name">Họ tên:</label>
				    						<span class="error">*<?php echo $nameErr;?></span>
                        <input type="text" class="form-control" id="name" placeholder="Họ và tên" name="name" value="<?php echo $name ?>">
                    </div>
    
                    <div class="form-group">
                        <label for="phoneNumber">Số điện thoại:</label>
				    						<span class="error">*<?php echo $phoneErr;?></span>

                        <input type="text" class="form-control" id="phoneNumber" placeholder="Số điện thoại" name="phone" value="<?php echo $phone ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
				    						<span class="error">*<?php echo $emailErr;?></span>

                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $email ?>">
                    </div>

                    <div class="form-group">
                        <label for="nationality">Quốc tịch:</label>
				    						<span class="error">*<?php echo $nationalityErr;?></span>

                        <select id="nationality" name="nationality">
														<option value="Afghanistan">Afghanistan</option>
														<option value="Albania">Albania</option>
														<option value="Algeria">Algeria</option>
														<option value="American Samoa">American Samoa</option>
														<option value="Andorra">Andorra</option>
														<option value="Angola">Angola</option>
														<option value="Anguilla">Anguilla</option>
														<option value="Antartica">Antarctica</option>
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
														<option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
														<option value="Botswana">Botswana</option>
														<option value="Bouvet Island">Bouvet Island</option>
														<option value="Brazil">Brazil</option>
														<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
														<option value="Brunei Darussalam">Brunei Darussalam</option>
														<option value="Bulgaria">Bulgaria</option>
														<option value="Burkina Faso">Burkina Faso</option>
														<option value="Burundi">Burundi</option>
														<option value="Cambodia">Cambodia</option>
														<option value="Cameroon">Cameroon</option>
														<option value="Canada">Canada</option>
														<option value="Cape Verde">Cape Verde</option>
														<option value="Cayman Islands">Cayman Islands</option>
														<option value="Central African Republic">Central African Republic</option>
														<option value="Chad">Chad</option>
														<option value="Chile">Chile</option>
														<option value="China">China</option>
														<option value="Christmas Island">Christmas Island</option>
														<option value="Cocos Islands">Cocos (Keeling) Islands</option>
														<option value="Colombia">Colombia</option>
														<option value="Comoros">Comoros</option>
														<option value="Congo">Congo</option>
														<option value="Congo">Congo, the Democratic Republic of the</option>
														<option value="Cook Islands">Cook Islands</option>
														<option value="Costa Rica">Costa Rica</option>
														<option value="Cota D'Ivoire">Cote d'Ivoire</option>
														<option value="Croatia">Croatia (Hrvatska)</option>
														<option value="Cuba">Cuba</option>
														<option value="Cyprus">Cyprus</option>
														<option value="Czech Republic">Czech Republic</option>
														<option value="Denmark">Denmark</option>
														<option value="Djibouti">Djibouti</option>
														<option value="Dominica">Dominica</option>
														<option value="Dominican Republic">Dominican Republic</option>
														<option value="East Timor">East Timor</option>
														<option value="Ecuador">Ecuador</option>
														<option value="Egypt">Egypt</option>
														<option value="El Salvador">El Salvador</option>
														<option value="Equatorial Guinea">Equatorial Guinea</option>
														<option value="Eritrea">Eritrea</option>
														<option value="Estonia">Estonia</option>
														<option value="Ethiopia">Ethiopia</option>
														<option value="Falkland Islands">Falkland Islands (Malvinas)</option>
														<option value="Faroe Islands">Faroe Islands</option>
														<option value="Fiji">Fiji</option>
														<option value="Finland">Finland</option>
														<option value="France">France</option>
														<option value="France Metropolitan">France, Metropolitan</option>
														<option value="French Guiana">French Guiana</option>
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
														<option value="Guinea">Guinea</option>
														<option value="Guinea-Bissau">Guinea-Bissau</option>
														<option value="Guyana">Guyana</option>
														<option value="Haiti">Haiti</option>
														<option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
														<option value="Holy See">Holy See (Vatican City State)</option>
														<option value="Honduras">Honduras</option>
														<option value="Hong Kong">Hong Kong</option>
														<option value="Hungary">Hungary</option>
														<option value="Iceland">Iceland</option>
														<option value="India">India</option>
														<option value="Indonesia">Indonesia</option>
														<option value="Iran">Iran (Islamic Republic of)</option>
														<option value="Iraq">Iraq</option>
														<option value="Ireland">Ireland</option>
														<option value="Israel">Israel</option>
														<option value="Italy">Italy</option>
														<option value="Jamaica">Jamaica</option>
														<option value="Japan">Japan</option>
														<option value="Jordan">Jordan</option>
														<option value="Kazakhstan">Kazakhstan</option>
														<option value="Kenya">Kenya</option>
														<option value="Kiribati">Kiribati</option>
														<option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
														<option value="Korea">Korea, Republic of</option>
														<option value="Kuwait">Kuwait</option>
														<option value="Kyrgyzstan">Kyrgyzstan</option>
														<option value="Lao">Lao People's Democratic Republic</option>
														<option value="Latvia">Latvia</option>
														<option value="Lebanon" selected>Lebanon</option>
														<option value="Lesotho">Lesotho</option>
														<option value="Liberia">Liberia</option>
														<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
														<option value="Liechtenstein">Liechtenstein</option>
														<option value="Lithuania">Lithuania</option>
														<option value="Luxembourg">Luxembourg</option>
														<option value="Macau">Macau</option>
														<option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
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
														<option value="Mayotte">Mayotte</option>
														<option value="Mexico">Mexico</option>
														<option value="Micronesia">Micronesia, Federated States of</option>
														<option value="Moldova">Moldova, Republic of</option>
														<option value="Monaco">Monaco</option>
														<option value="Mongolia">Mongolia</option>
														<option value="Montserrat">Montserrat</option>
														<option value="Morocco">Morocco</option>
														<option value="Mozambique">Mozambique</option>
														<option value="Myanmar">Myanmar</option>
														<option value="Namibia">Namibia</option>
														<option value="Nauru">Nauru</option>
														<option value="Nepal">Nepal</option>
														<option value="Netherlands">Netherlands</option>
														<option value="Netherlands Antilles">Netherlands Antilles</option>
														<option value="New Caledonia">New Caledonia</option>
														<option value="New Zealand">New Zealand</option>
														<option value="Nicaragua">Nicaragua</option>
														<option value="Niger">Niger</option>
														<option value="Nigeria">Nigeria</option>
														<option value="Niue">Niue</option>
														<option value="Norfolk Island">Norfolk Island</option>
														<option value="Northern Mariana Islands">Northern Mariana Islands</option>
														<option value="Norway">Norway</option>
														<option value="Oman">Oman</option>
														<option value="Pakistan">Pakistan</option>
														<option value="Palau">Palau</option>
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
														<option value="Russia">Russian Federation</option>
														<option value="Rwanda">Rwanda</option>
														<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
														<option value="Saint LUCIA">Saint LUCIA</option>
														<option value="Saint Vincent">Saint Vincent and the Grenadines</option>
														<option value="Samoa">Samoa</option>
														<option value="San Marino">San Marino</option>
														<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
														<option value="Saudi Arabia">Saudi Arabia</option>
														<option value="Senegal">Senegal</option>
														<option value="Seychelles">Seychelles</option>
														<option value="Sierra">Sierra Leone</option>
														<option value="Singapore">Singapore</option>
														<option value="Slovakia">Slovakia (Slovak Republic)</option>
														<option value="Slovenia">Slovenia</option>
														<option value="Solomon Islands">Solomon Islands</option>
														<option value="Somalia">Somalia</option>
														<option value="South Africa">South Africa</option>
														<option value="South Georgia">South Georgia and the South Sandwich Islands</option>
														<option value="Span">Spain</option>
														<option value="SriLanka">Sri Lanka</option>
														<option value="St. Helena">St. Helena</option>
														<option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
														<option value="Sudan">Sudan</option>
														<option value="Suriname">Suriname</option>
														<option value="Svalbard">Svalbard and Jan Mayen Islands</option>
														<option value="Swaziland">Swaziland</option>
														<option value="Sweden">Sweden</option>
														<option value="Switzerland">Switzerland</option>
														<option value="Syria">Syrian Arab Republic</option>
														<option value="Taiwan">Taiwan, Province of China</option>
														<option value="Tajikistan">Tajikistan</option>
														<option value="Tanzania">Tanzania, United Republic of</option>
														<option value="Thailand">Thailand</option>
														<option value="Togo">Togo</option>
														<option value="Tokelau">Tokelau</option>
														<option value="Tonga">Tonga</option>
														<option value="Trinidad and Tobago">Trinidad and Tobago</option>
														<option value="Tunisia">Tunisia</option>
														<option value="Turkey">Turkey</option>
														<option value="Turkmenistan">Turkmenistan</option>
														<option value="Turks and Caicos">Turks and Caicos Islands</option>
														<option value="Tuvalu">Tuvalu</option>
														<option value="Uganda">Uganda</option>
														<option value="Ukraine">Ukraine</option>
														<option value="United Arab Emirates">United Arab Emirates</option>
														<option value="United Kingdom">United Kingdom</option>
														<option value="United States">United States</option>
														<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
														<option value="Uruguay">Uruguay</option>
														<option value="Uzbekistan">Uzbekistan</option>
														<option value="Vanuatu">Vanuatu</option>
														<option value="Venezuela">Venezuela</option>
														<option value="Vietnam">Viet Nam</option>
														<option value="Virgin Islands (British)">Virgin Islands (British)</option>
														<option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
														<option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
														<option value="Western Sahara">Western Sahara</option>
														<option value="Yemen">Yemen</option>
														<option value="Serbia">Serbia</option>
														<option value="Zambia">Zambia</option>
														<option value="Zimbabwe">Zimbabwe</option>
												</select>

                    </div>

                    <div class="form-group">
                        <label for="dob">Ngày sinh:</label>
				   							<span class="error">*<?php echo $dobErr;?></span>

                        <input type="date" class="form-control" id="dob" placeholder="Ngày sinh" name="dob" value="<?php echo $date ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="avatar">Ảnh đại diện:</label>
				    						<span class="error">*<?php echo $avatarErr;?></span>

                        <input type="file" id="avatar" name="avatar">
                    </div>

                    <div class="form-group">
                      <label>Đăng ký chủ đề:</label>
                      <span class="error ml-3">*<?php echo $themeErr;?></span>


                      <div class="form-check ml-5">
                        <input class="form-check-input" type="radio" name="theme" id="theme1" value="Nghệ thuật"> 
                        <label class="form-check-label" for="theme1">Tiết mục nghệ thuật</label>
                      </div>

                      <div class="form-check ml-5">
                        <input class="form-check-input" type="radio" name="theme" id="theme2" value="Diễn giả"> 
                        <label class="form-check-label" for="theme2">Diễn giả</label>
                      </div>

                      <div class="form-check ml-5">
                        <input class="form-check-input" type="radio" name="theme" id="theme3" value="Tài trợ"> 
                        <label class="form-check-label" for="theme3">Nhà tài trợ</label>
                      </div>                      
                      
                    </div>

                    <div class="form-group">
                        <label for="desc">Mô tả thêm:</label>
                        <span class="error ml-3">*<?php echo $descErr;?></span>

                        <textarea class="form-control" id="desc" rows="5" name="desc" value="<?php echo $description ?>"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary">Đăng ký</button>
                    </div>
                </form>    
                
            </div>
        </div>
    </div>

<!-- contact and footer -->
<div id="contact" class="contact">
    <div class="container">
        <h2 class="text-main text-center"><strong>Liên lạc</strong></h2>
        <div class="row">
            <div class="col-sm-5">
                <h6>Hãy liên lạc với chúng tôi, thường trả lời trong vòng 8h.</h6>
                <p class="contact-phonenumber">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                    0123456789
                </p>
                <p class="contact-phonenumber">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                    </svg>
                    multi_level@gmail.com
                </p><p class="contact-phonenumber">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    HỌC VIỆN CÔNG NGHỆ BƯU CHÍNH VIỄN THÔNG, HÀ NỘI
                </p>
                
            </div>
            <div class="col-sm-7 slide">
                <!-- Social-link -->
                <div class="social-link d-flex justify-content-center">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path class="icon" d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" style="color: white;"/>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" style="color: white;"/>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" style="color: white;"/>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" style="color: white;"/>
                        </svg>
                    </a>
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" style="color: white;"/>
                        </svg>
                    </a>
                    
                </div>         
            </div>
        </div>
        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-3">
                                <p><strong>Nhận thông báo qua email:</strong></p>
                            </div>
                            <div class="col-lg-7">
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="col-lg-2">
                                <button class="btn btn-secondary">Yêu cầu</button>
                            </div>
                        </div>                                
                    </div>
                </div>
            </div>                
        </form>
    </div>          
</div>
<footer class="footer">
    <div class="container text-center">
        <div class="back-to-top">
            <a href="#myPage" title="Back to top">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" style="color: white;"/>
                </svg>
            </a>    
        </div>        
        <p class="text-white">© By Multi Level.</p>
    </div>          
</footer>


	
</body>
</html>
