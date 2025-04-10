                            <!-- pay at hotel -->
                            <?php
                                $directPayments = unserialize($data->directPayments);
                                $second_directPayments = unserialize($data->second_directPayments);
                                $third_directPayments = unserialize($data->third_directPayments);
                            ?>
                            <div class="pay-at-hotel-cont">
                                @if($directPayments['amount'] > 0 || $second_directPayments['amount'] > 0 || $third_directPayments['amount'] > 0)
                                    <h3>Mandatory Charges</h3>
                                    <h4>Extra charges to be paid directly at the property</h4>
                                @endif

                                <div class="pay-at-hotel-wrapper">
                                    
                                    @if($directPayments['amount'] > 0)
                                        <div class="items">
                                            <div class="content">
                                                {{$directPayments['type']}}
                                                <p>To be paid in property currency</p>
                                            </div>
                                            <div class="price">
                                                <span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($directPayments['amount'])}}
                                                <p>(appx. charges)</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($second_directPayments['amount'] > 0)
                                        <div class="items">
                                            <div class="content">
                                                {{$second_directPayments['type']}}
                                                <p>To be paid in property currency</p>
                                            </div>
                                            <div class="price">
                                                <span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($second_directPayments['amount'])}}
                                                <p>(appx. charges)</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($third_directPayments['amount'] > 0)
                                        <div class="items">
                                            <div class="content">
                                                {{$third_directPayments['type']}}
                                                <p>To be paid in property currency</p>
                                            </div>
                                            <div class="price">
                                                <span class="defaultCurencyPay"></span>&nbsp;{{CustomHelpers::get_indian_currency($third_directPayments['amount'])}}
                                                <p>(appx. charges)</p>
                                            </div>
                                        </div>
                                    @endif

                                    <div>
                                        <!-- Additional content here if needed -->
                                    </div>
                                </div>
                            </div>