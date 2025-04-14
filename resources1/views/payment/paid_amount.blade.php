                            <!-- amount paid -->
                            <div class="amountPaidBox">
                                <div>
                                    <h2>Amount Paid</h2>
                                </div>
                                <div>
                                    <h2>
                                        <span class="defaultCurencyPay">
                                            &nbsp;{{ CustomHelpers::get_indian_currency(CustomHelpers::get_paid_amount($unique_code)) }}
                                        </span>
                                    </h2>
                                </div>
                            </div>
                            <!-- charges paid -->
                            <div class="amountPaidBox">
                                <div>
                                    <h2>Charge Paid</h2>
                                </div>
                                <div>
                                    <h2>
                                        <span class="defaultCurencyPay">
                                            &nbsp;{{ CustomHelpers::get_indian_currency(CustomHelpers::get_charge_amount($unique_code)) }}
                                        </span>
                                    </h2>
                                </div>
                            </div>
                            <!-- total paid -->
                            <div class="amountPaidBox">
                                <div>
                                    <h2>Total Paid</h2>
                                </div>
                                <div>
                                    <h2>
                                        <span class="defaultCurencyPay">
                                            &nbsp;{{ CustomHelpers::get_indian_currency(CustomHelpers::get_paid_amount($unique_code) + CustomHelpers::get_charge_amount($unique_code)) }}
                                        </span>
                                    </h2>
                                </div>
                            </div>