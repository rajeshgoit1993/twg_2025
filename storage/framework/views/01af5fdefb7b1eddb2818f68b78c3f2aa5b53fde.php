                            <!-- pay at hotel -->
                            <?php
                                $directPayments = unserialize($data->directPayments);
                                $second_directPayments = unserialize($data->second_directPayments);
                                $third_directPayments = unserialize($data->third_directPayments);
                            ?>
                            <div class="pay-at-hotel-cont">
                                <?php if($directPayments['amount'] > 0 || $second_directPayments['amount'] > 0 || $third_directPayments['amount'] > 0): ?>
                                    <h3>Mandatory Charges</h3>
                                    <h4>Extra charges to be paid directly at the property</h4>
                                <?php endif; ?>

                                <div class="pay-at-hotel-wrapper">
                                    
                                    <?php if($directPayments['amount'] > 0): ?>
                                        <div class="items">
                                            <div class="content">
                                                <?php echo e($directPayments['type']); ?>

                                                <p>To be paid in property currency</p>
                                            </div>
                                            <div class="price">
                                                <span class="defaultCurencyPay"></span>&nbsp;<?php echo e(CustomHelpers::get_indian_currency($directPayments['amount'])); ?>

                                                <p>(appx. charges)</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($second_directPayments['amount'] > 0): ?>
                                        <div class="items">
                                            <div class="content">
                                                <?php echo e($second_directPayments['type']); ?>

                                                <p>To be paid in property currency</p>
                                            </div>
                                            <div class="price">
                                                <span class="defaultCurencyPay"></span>&nbsp;<?php echo e(CustomHelpers::get_indian_currency($second_directPayments['amount'])); ?>

                                                <p>(appx. charges)</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($third_directPayments['amount'] > 0): ?>
                                        <div class="items">
                                            <div class="content">
                                                <?php echo e($third_directPayments['type']); ?>

                                                <p>To be paid in property currency</p>
                                            </div>
                                            <div class="price">
                                                <span class="defaultCurencyPay"></span>&nbsp;<?php echo e(CustomHelpers::get_indian_currency($third_directPayments['amount'])); ?>

                                                <p>(appx. charges)</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div>
                                        <!-- Additional content here if needed -->
                                    </div>
                                </div>
                            </div>