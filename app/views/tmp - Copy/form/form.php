            <form class="form-horizontal" action="dashboard.html" method="post">
                <div class="container">

                    <div class="alert alert-block alert-info">
                        <p>
                            Enter updated security information for your account as desired.  Fields marked with an asterisk
                            are required.
                        </p>
                    </div>
                    <div class="row">
                        <div id="acct-password-row" class="span7">
                            <fieldset>
                                <legend>Account Password</legend><br>
                                <div class="control-group ">
                                    <label class="control-label">Current Password <span class="required">*</span></label>
                                    <div class="controls">
                                        <input id="current-pass-control" name="password" class="span4" type="password" value="" autocomplete="false">

                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label class="control-label">New Password</label>
                                    <div class="controls">
                                        <input id="new-pass-control" name="newPassword" class="span4" type="password" value="" autocomplete="false">

                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label class="control-label">Verify New Password</label>
                                    <div class="controls">
                                        <input id="new-pass-verify-control" name="newPasswordVerification" class="span4" type="password" value="" autocomplete="false">

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div id="acct-verify-row" class="span9">
                            <fieldset>
                                <legend>Account Verification</legend>
                                <div class="control-group">
                                    <label for="challengeQuestion" class="control-label">Question</label>
                                    <div class="controls">
                                        <select id="challenge_question_control" class="span5">
                                            <option value="">-- Select a Question --</option>
                                            <option value="In which city were you born?">
                                                In which city were you born?
                                            </option>
                                            <option value="What is your birth date?">
                                                What is your birth date?
                                            </option>
                                            <option value="What are the last four digits of your driver's license number?">
                                                What are the last four digits of your drivers license number?
                                            </option>
                                            <option value="What is your zip or postal code?">
                                                What is your zip or postal code?
                                            </option>
                                            <option value="What high school did you attend?">
                                                What high school did you attend?
                                            </option>
                                            <option value="What was the name of your first pet?">
                                                What was the name of your first pet?
                                            </option>
                                            <option value="What is your father's middle name?">
                                                What is your father's middle name?
                                            </option>
                                            <option value="What is your mother's middle name?">
                                                What is your mother's middle name?
                                            </option>
                                            <option value="What is your mother's maiden name?">
                                                What is your mother's maiden name?
                                            </option>
                                            <option value="What is your spouse's middle name?">
                                                What is your spouse's middle name?
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label class="control-label">Answer</label>
                                    <div class="controls">
                                        <input id="challenge-answer-control" name="challengeAnswer" class="span5" type="password" value="" autocomplete="false">

                                    </div>
                                </div>
                                <div class="control-group ">
                                    <label class="control-label">Verify Answer</label>
                                    <div class="controls">
                                        <input id="challenge-answer-verify-control" name="challengeAnswerVerification" class="span5" type="password" value="" autocomplete="false">

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <footer id="submit-actions" class="form-actions">
                        <button id="submit-button" type="submit" class="btn btn-primary" name="action" value="CONFIRM">Save</button>
                        <button type="submit" class="btn" name="action" value="CANCEL">Cancel</button>
                    </footer>
                </div>
            </form>