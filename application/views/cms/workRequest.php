<div class="content-wrap">
    <main id="content" class="content" role="main">
        <h3 class="page-title"><span class="fw-semi-bold"><?php echo $title;?></span></h3>
        <div class="row">
            <div class="col-md-12">
                <section class="widget">
                    <header>
                        <h4>
                            Wizard
                            <small>Tunable widget</small>
                        </h4>
                        <div class="widget-controls">
                            <a data-widgster="expand" title="Expand" href="#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                            <a data-widgster="collapse" title="Collapse" href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
                            <a data-widgster="close" title="Close" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </header>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Inpage <strong>Wizard</strong></h4>
                                <p>An example of complete wizard form in widget.</p>

                                <div id="wizard" class="form-wizard">
                                    <ul class="nav-justified mb-sm">
                                        <li><a href="#tab1" data-toggle="tab">
                                            <small>1.</small>
                                             Your Details</a></li>
                                        <li><a href="#tab2" data-toggle="tab">
                                            <small>2.</small>
                                            Shipping</a></li>
                                        <li><a href="#tab3" data-toggle="tab">
                                            <small>3.</small>
                                            Pay</a></li>
                                        <li><a href="#tab4" data-toggle="tab">
                                            <small>4.</small>
                                            Thank you!</a></li>
                                    </ul>
                                    <div id="bar" class="progress progress-xs">
                                        <div class="progress-bar progress-bar-gray-light"></div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane bg-gray-lighter" id="tab1">
                                            <form action='' method="POST"
                                                  data-parsley-priority-enabled="false"
                                                  novalidate="novalidate">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <!-- Username -->
                                                        <label for="username">Username</label>
                                                            <input type="text" id="username" name="username" placeholder=""
                                                                   class="form-control"
                                                                    required="required">
                                                            <span class="help-block">Username can contain any letters or numbers, without spaces</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- Email -->
                                                        <label for="email">Email</label>
                                                            <input type="email" id="email" name="email"
                                                                   placeholder="" class="form-control"
                                                                   data-parsley-trigger="change"
                                                                    required="required">
                                                            <span class="help-block">Please provide your E-mail</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <!-- Password -->
                                                        <label for="address">Address</label>
                                                            <input type="text" id="address" name="address" placeholder=""
                                                                   class="form-control">
                                                            <span class="help-block">Please provide your address</span>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="tab-pane bg-gray-lighter" id="tab2">
                                            <form action='' method="POST"
                                                  data-parsley-priority-enabled="false"
                                                  novalidate="novalidate">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label for="country-select">Destination Country</label>
                                                        <select id="country-select" data-placeholder="Choose a Country..."
                                                                class="form-control chzn-select">
                                                        <option value=""></option>
                                                        <option value="United States">United States</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="Afghanistan">Afghanistan</option>
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
                                                        <option value="Cameroon">Cameroon</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Cape Verde">Cape Verde</option>
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
                                                        <option value="Czech Republic">Czech Republic</option>
                                                        <option value="Denmark">Denmark</option>
                                                        <option value="Djibouti">Djibouti</option>
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
                                                        <option value="Fiji">Fiji</option>
                                                        <option value="Finland">Finland</option>
                                                        <option value="France">France</option>
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
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Jamaica">Jamaica</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Jordan">Jordan</option>
                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                        <option value="Kenya">Kenya</option>
                                                        <option value="Kiribati">Kiribati</option>
                                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of
                                                        </option>
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
                                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic
                                                            of
                                                        </option>
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
                                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
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
                                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich
                                                            Islands
                                                        </option>
                                                        <option value="South Sudan">South Sudan</option>
                                                        <option value="Spain">Spain</option>
                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                        <option value="Sudan">Sudan</option>
                                                        <option value="Suriname">Suriname</option>
                                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                        <option value="Swaziland">Swaziland</option>
                                                        <option value="Sweden">Sweden</option>
                                                        <option value="Switzerland">Switzerland</option>
                                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                        <option value="Taiwan, Republic of China">Taiwan, Republic of China</option>
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
                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
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
                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                        </select>
                                                        <span class="help-block">Please choose your country destination</span>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="courier">Choose shipping option</label>


                                                            <select id="courier" data-placeholder="Choose an option.."
                                                                                           class="form-control chzn-select">
                                                                <option value=""></option>
                                                                <option value="Australia Post">Australia Post</option>
                                                                <option value="DHL US">DHL US</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                            <span class="help-block">Please choose your shipping option</span>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="destination">Destination Zip Code</label>


                                                        <input type="text" id="destination" name="destination" placeholder=""
                                                                                      class="form-control" required="required">
                                                        <span class="help-block">Please provide your Destination Zip Code</span>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dest-address">Destination Address</label>


                                                        <input type="text" id="dest-address" name="address" placeholder=""
                                                                                          class="form-control">
                                                        <span class="help-block">Please provide the destination address</span>

                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="tab-pane bg-gray-lighter" id="tab3">
                                            <form action='' method="POST">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <label for="name">Name on the Card</label>


                                                        <input type="text" id="name" name="name" placeholder=""
                                                                                          class="form-control" required="required">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="credit-card-type">Credit Card Type</label>


                                                        <select id="credit-card-type"
                                                                                       data-placeholder="Please select.."
                                                                                       class="form-control chzn-select" required="required">
                                                            <option value=""></option>
                                                            <option value="Visa">Visa</option>
                                                            <option value="Mastercard">Mastercard</option>
                                                            <option value="Other">Other</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="credit">Credit Card Number </label>


                                                        <input id="credit" type="text" tabindex="3"
                                                                                      class="form-control" required="required">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="expiration-date">Expiration Date</label>


                                                        <input type="text" id="expiration-date"
                                                                                      class="form-control" required="required">

                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="tab-pane bg-gray-lighter" id="tab4">
                                            <h2>Thank you!</h2>

                                            <p>Your submission has been received.</p>
                                        </div>
                                        <ul class="pager wizard">
                                            <li class="previous">
                                                <button class="btn btn-default btn-rounded pull-left">
                                                    <i class="fa fa-caret-left"></i> &nbsp; Previous
                                                </button>
                                            </li>
                                            <li class="next">
                                                <button class="btn btn-primary btn-rounded pull-right" >
                                                    Next &nbsp; <i class="fa fa-caret-right"></i></button>
                                            </li>
                                            <li class="finish" style="display: none">
                                                <button class="btn btn-success btn-rounded pull-right" >
                                                    Finish &nbsp; <i class="glyphicon glyphicon-ok"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h4>Modal <strong>Application Wizard</strong></h4>
                                <p>An example of complete wizard form in a modal.</p>
                                <button class="btn btn-info btn-rounded" id="open-wizard" type="button" >
                                    Launch Wizard
                                </button>
                                <div class="wizard" id="satellite-wizard" data-title="Create Server">

                                    <!-- Step 1 Name & FQDN -->
                                    <div class="wizard-card" data-cardname="name">
                                        <h3>Name & FQDN</h3>

                                        <div class="wizard-input-section">
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="label" name="label" placeholder="Server label" data-validate="validateServerLabel">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="wizard-input-section">
                                            <p>
                                                Full Qualified Domain Name
                                            </p>

                                            <div class="form-group">
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="fqdn" name="fqdn" placeholder="FQDN" data-validate="validateFQDN" data-is-valid="0" data-lookup="0" />
								<span class="input-group-btn" id="btn-fqdn">
									<button class="btn btn-default" type="button" onclick='lookup();'>
                                        Lookup
                                    </button> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="wizard-input-section">
                                            <p>
                                                Server ip.
                                            </p>

                                            <div class="form-group">
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="ip" name="ip" placeholder="IP" data-serialize="1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="wizard-card" data-cardname="group">
                                        <h3>Server Group</h3>

                                        <div class="wizard-input-section">
                                            <p>
                                                Where would you like server <strong class="create-server-name"></strong>
                                                to go?
                                            </p>

                                            <img class="wizard-group-list" src="/vendor/bootstrap-application-wizard/demo/img/groups.png" />
                                        </div>
                                    </div>

                                    <div class="wizard-card wizard-card-overlay" data-cardname="services">
                                        <h3>Service Selection</h3>

                                        <div class="alert hide">
                                            It's recommended that you select at least one
                                            service, like ping.
                                        </div>

                                        <div class="wizard-input-section">
                                            <p>
                                                Please choose the services you'd like Panopta to
                                                monitor.  Any service you select will be given a default
                                                check frequency of 1 minute.
                                            </p>

                                            <select name="services" data-placeholder="Service List" style="width:350px;" class="chzn-select create-server-service-list form-control" multiple>

                                                <option value=""></option>
                                                <optgroup label="Basic">
                                                    <option selected value="icmp.ping">Ping</option>
                                                    <option selected value="tcp.ssh">SSH</option>
                                                    <option value="tcp.ftp">FTP</option>
                                                </optgroup>
                                                <optgroup label="Web">
                                                    <option selected value="tcp.http">HTTP</option>
                                                    <option value="tcp.https">HTTP (Secure)</option>
                                                    <option value="tcp.dns">DNS</option>
                                                </optgroup>
                                                <optgroup label="Email">
                                                    <option value="tcp.pop">POP</option>
                                                    <option value="tcp.imap">IMAP</option>
                                                    <option value="tcp.smtp">SMTP</option>
                                                    <option value="tcp.pops">POP (Secure)</option>
                                                    <option value="tcp.imaps">IMAP (Secure)</option>
                                                    <option value="tcp.smtps">SMTP (Secure)</option>
                                                    <option value="tcp.http.exchange">Microsoft Exchange</option>
                                                </optgroup>
                                                <optgroup label="Databases">
                                                    <option value="tcp.mysql">MySQL</option>
                                                    <option value="tcp.postgres">PostgreSQL</option>
                                                    <option value="tcp.mssql">Microsoft SQL Server</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="wizard-card wizard-card-overlay" data-cardname="location">
                                        <h3>Monitoring Location</h3>

                                        <div class="wizard-input-section">
                                            <p>
                                                We determined <strong>Chicago</strong> to be
                                                the closest location to monitor
                                                <strong class="create-server-name"></strong>
                                                If you would like to change this, or you think this is
                                                incorrect, please select a different
                                                monitoring location.
                                            </p>

                                            <select name="location" data-placeholder="Monitor nodes" style="width:350px;" class="chzn-select form-control">
                                                <option value=""></option>
                                                <optgroup label="North America">
                                                    <option>Atlanta</option>
                                                    <option selected>Chicago</option>
                                                    <option>Dallas</option>
                                                    <option>Denver</option>
                                                    <option>Fremont, CA</option>
                                                    <option>Los Angeles</option>
                                                    <option>Miami</option>
                                                    <option>Newark, NJ</option>
                                                    <option>Phoenix</option>
                                                    <option>Seattle</option>
                                                    <option>Washington, DC</option>
                                                </optgroup>

                                                <optgroup label="Europe">
                                                    <option>Amsterdam, NL</option>
                                                    <option>Berlin</option>
                                                    <option>London</option>
                                                    <option>Milan, Italy</option>
                                                    <option>Nurnberg, Germany</option>
                                                    <option>Paris</option>
                                                    <option>Stockholm</option>
                                                    <option>Vienna</option>
                                                </optgroup>

                                                <optgroup label="Asia/Africa">
                                                    <option>Cairo</option>
                                                    <option>Jakarta</option>
                                                    <option>Johannesburg</option>
                                                    <option>Hong Kong</option>
                                                    <option>Singapore</option>
                                                    <option>Sydney</option>
                                                    <option>Tokyo</option>
                                                </optgroup>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="wizard-card wizard-card-overlay">
                                        <h3>Notification Schedule</h3>

                                        <div class="wizard-input-section">
                                            <p>
                                                Select the notification schedule to be used for outages.
                                            </p>

                                            <select name="notification" class="wizard-ns-select chzn-select form-control" data-placeholder="Notification schedule" style="width:350px;">
                                                <option value=""></option>
                                                <option>ALIS Production</option>
                                                <option>ALIS Development &amp; Staging</option>
                                                <option>Panopta Development &amp; Staging</option>
                                                <option>Jira</option>
                                                <option>QSC Enterprise Production</option>
                                                <option>QSC Enterprise Development &amp; Staging</option>
                                                <option>Panopta Production</option>
                                                <option>Panopta Monitoring Nodes</option>
                                                <option>Common</option>
                                            </select>
                                        </div>

                                        <div class="wizard-ns-detail hide">
                                            Also using <strong>ALIS Production</strong>:

                                            <ul id="wizard-ns-detail-servers">
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/folder.png" />Corporate sites</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/folder.png" />dt01.sat.medtelligent.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />alisonline.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />circa-db04.sat.medtelligent.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />circa-services01.sat.medtelligent.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />circa-web01.sat.medtelligent.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />heartbeat.alisonline.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />medtelligent.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />dt02.fre.medtelligent.com</li>
                                                <li><img src="/vendor/bootstrap-application-wizard/demo/img/server_new.png" />dev03.lin.medtelligent.com</li>
                                            </ul>img				</div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>
<!-- The Loader. Is shown when pjax happens -->
<div class="loader-wrap hiding hide">
    <i class="fa fa-circle-o-notch fa-spin-fast"></i>
</div>

<!-- common libraries. required for every page-->
<script src="/vendor/jquery/dist/jquery.min.js"></script>
<script src="/vendor/jquery-pjax/jquery.pjax.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/transition.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/collapse.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/dropdown.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/button.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/tooltip.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/alert.js"></script>
<script src="/vendor/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
<script src="/vendor/widgster/widgster.js"></script>
<script src="/vendor/pace.js/pace.min.js"></script>
<script src="/vendor/jquery-touchswipe/jquery.touchSwipe.js"></script>

<!-- common app js -->
<script src="/js/settings.js"></script>
<script src="/js/app.js"></script>

<!-- page specific libs -->
<script src="/vendor/parsleyjs/dist/parsley.min.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/tab.js"></script>
<script src="/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="/vendor/select2/select2.js"></script>
<script src="/vendor/moment/min/moment.min.js"></script>
<script src="/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/vendor/jasny-bootstrap/js/inputmask.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/modal.js"></script>
<script src="/vendor/bootstrap-sass/vendor/assets/javascripts/bootstrap/popover.js"></script>
<script src="/vendor/bootstrap-application-wizard/src/bootstrap-wizard.js"></script>

<!-- page specific js -->
<script src="/js/form-wizard.js"></script>

